<?php

declare(strict_types=1);

namespace App\Managers\Rental;

use App\Models\Payment;
use App\Models\Rental;
use App\Services\Payment\PaymentIntentService;
use App\Services\Payment\PaymentMethodService;
use App\Services\Rental\RentalService;
use App\Services\Scooter\ScooterService;
use App\Services\Station\StationService;
use App\Services\Stripe\StripeApiService;
use App\Services\User\UserService;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentalManager
{
    public function __construct(
        private readonly RentalService $rentalService,
        private readonly ScooterService $scooterService,
        private readonly PaymentIntentService $paymentService,
        private readonly UserService $userService,
        private readonly StripeApiService $stripeApiService,
        private readonly StationService $stationService,
        private readonly PaymentMethodService $paymentMethodService
    ) {}

    public function getRentalsHistoryByUser(int $userId, int $limit = 10, int $offset = 0): Collection
    {
        $rentals = $this->rentalService->getRentalsHistoryByUser(
            $userId,
            $limit,
            $offset
        );

        return $rentals;
    }

    public function getOngoingRentals(int $limit = 10, int $offset = 0): Collection
    {
        $rentals = $this->rentalService->getOngoingRentals(
            $limit,
            $offset
        );

        return $rentals;
    }

    public function get(int $id)
    {
        $rental = $this->rentalService->get($id);
        if (!$rental) {
            throw new ModelNotFoundException('Rental not found');
        }
        return $rental;
    }

    public function getAll(int $limit = 10, int $offset = 0): Collection
    {
        return $this->rentalService->getAll($limit, $offset);
    }

    public function startRental(string $scooterUid): Rental
    {
        try {
            // Retrieving the user
            $user = Auth::user();

            DB::connection('mysql')->beginTransaction();
            // Check if user can start the rental: its a combination of this bullet points: 
            // - User has no ongoing rentals
            // - User has no unpaid rentals
            // - User has a valid payment method
            // - User has a valid driver's license inserted, so valid document updated on stripe with identity (KYC)
            // - Scooter is available, and with battery charged (100%)

            $checkIfIsEligible = $this->userService->checkIfUserIsEligibleForRent($user->id);
            if (!$checkIfIsEligible->documentVerificationId) {
                throw new \Exception("User must have a valid driver's license inserted");
            }

            if (!$checkIfIsEligible->emailVerifiedAt) {
                throw new \Exception("User must have a verified email!");
            }

            if (!$checkIfIsEligible->defaultPaymentMethodId) {
                throw new \Exception("User must have a valid payment method!");
            }

            if ($checkIfIsEligible->unpaidRentalsCount > 0) {
                throw new \Exception("User has some unpaid rentals. Close the payments before starting a new rent.");
            }

            if ($checkIfIsEligible->ongoingRentalsCount !== 0) {
                throw new \Exception("Can't start a new rent with an ongoing one!");
            }

            $isScooterAvailable = $this->scooterService->checkIfIsRentableByUid($scooterUid);

            if (!$isScooterAvailable) {
                throw new \Exception("The selected scooter is not available.");
            }
            // 1 : payment vs stripe (delayed)
            // 2 : saving payment intent on our database
            // 3 : saving rental element on our database
            // 4 : updating the scooter: setting status as rent, setting null as current_station_id

            // Retrieving default payment method mapping
            $paymentMethod = $this->paymentMethodService->get($user->default_payment_method_id);

            // TODO This should be a configuration value, maybe cached or stored in the database
            $startingAmount = 290; // 2.90€ base starting price saved in cents 
            $paymentIntent = $this->stripeApiService->createPaymentIntent([
                'description' => 'Starting rental for scooter ' . $scooterUid . ' by customer ' . $user->payment_gateway_customer_id,
                'amount' => $startingAmount,
                'currency' => 'eur',
                'customer' => $user->payment_gateway_customer_id,  // gateway customer id
                'payment_method' => $paymentMethod->payment_gateway_payment_method_id,
                'capture_method' => 'manual',  // This way we can confirm the payment later, delayed, with the capture() method
                'confirm' => true,
                'off_session' => true, // THe user is not directly involved in the payment process
                'metadata' => [
                    'scooter' => $scooterUid,
                    'user' => $user->id
                ]
            ]);

            // saving the payment intent on our database
            $payment = new Payment();
            $payment->user_id = $user->id;
            $payment->payment_gateway_intent_id = $paymentIntent->id;
            $payment->amount = $startingAmount;
            $payment->status = 'pending'; // After
            $payment->payment_method_id = $user->default_payment_method_id;

            $payment = $this->paymentService->insert($payment);

            $rental = new Rental();
            $rental->user_id = $user->id;
            $rental->scooter_id = $scooterUid;
            $rental->status = 'starting';
            $rental->payment_intent_id = $payment->id;
            $rental->payment_gateway_intent_id = $paymentIntent->id;
            $rental->start_date = now()->getTimestamp();
            $rental->end_date = null;
            $rental->amount = $startingAmount;
            $rental->$rental = $this->rentalService->insert($rental);

            $payment->rental_id = $rental->id;

            $payment = $this->paymentService->update($payment);

            // updating the scooter
            $scooter = $this->scooterService->getByUid($scooterUid);
            $scooter->status = 'rented';
            $scooter->current_station_id = null;
            $scooter = $this->scooterService->update($scooter);

            DB::connection('mysql')->commit();
            // TODO Exception discrimination: check if the exception is a stripe exception, a database exception, or a custom exception
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            throw $e;
        }
        return $rental;
    }

    public function endRental(
        string $scooterUid,
        int $rentalId,
        int $stationId,
        float $batteryLevel
    ) {
        try {
            DB::connection('mysql')->beginTransaction();
            $user = Auth::user();
            // Check if user can end the rental
            $rental = $this->rentalService->get($rentalId);
            if (!$rental) {
                throw new ModelNotFoundException('Rental not found!');
            }

            if ($rental->user_id !== $user->id) {
                throw new \Exception('User is not the owner of the rental!');
            }

            if ($rental->status !== 'ongoing') {
                throw new \Exception('Rental is not ongoing!');
            }
            // Retrieve the payment from our database
            $payment = $this->paymentService->get($rental->payment_intent_id);
            if (!$payment) {
                throw new ModelNotFoundException('Payment not found!');
            }
            // Check if the station has available spots
            $stationCapacity = $this->stationService->getRemainingCapacity($stationId);

            if ($stationCapacity === 0) {
                throw new \Exception('The station is full!');
            }

            // Retrieve the payment intent from stripe
            $paymentIntent = $this->stripeApiService->getPaymentIntent($payment->payment_gateway_intent_id);
            $endDate = now()->getTimestamp();
            // Evaluating the duration in seconds
            $duration = $endDate - $rental->start_date;

            // TODO Random amounts... to think about
            $totalAmount = 290 + ($duration * 0.1); // 2.90€ + 0.1€ per second

            // Closing here the rental: this way, even if the webhook fails, the rental is closed and the scooter can be rented again
            $rental->amount = $totalAmount;
            $rental->status = 'finished';
            $rental->end_date = $endDate;
            $rental->ending_station_id = $stationId;
            $rental = $this->rentalService->update($rental);

            // Now we can capture it with the right amount: first evaluating the amount to charge; This will trigger the webhook.
            $paymentIntent = $this->stripeApiService->capturePaymentIntent($paymentIntent->id, $totalAmount);
            // Updating the rental
            // Updating the scooter
            $scooter = $this->scooterService->getByUid($scooterUid);
            $scooter->status = 'recharging';
            $scooter->current_station_id = $stationId;
            $scooter->battery_level = $batteryLevel;
            $scooter = $this->scooterService->update($scooter);

            DB::connection('mysql')->commit();
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            throw $e;
        }
        return $rental;
    }
}
