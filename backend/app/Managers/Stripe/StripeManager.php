<?php

declare(strict_types=1);

namespace App\Managers\Stripe;


use App\Models\UserPaymentMethod;
use App\Services\Payment\PaymentGatewayEventService;
use App\Services\Payment\PaymentIntentService;
use App\Services\Payment\PaymentMethodService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;
use Stripe\Event;

// Webhook manager
class StripeManager
{
    public function __construct(
        private readonly PaymentIntentService $paymentService,
        private readonly PaymentMethodService $paymentMethodService,
        private readonly UserService $userService,
        private readonly PaymentGatewayEventService $paymentGatewayEventService,
    ) {}

    public function managePaymentIntent(Event $stripePaymentIntent): void
    {
        // Rertieve the payment intent from the event
        try {
            DB::connection('mysql')->beginTransaction();
            $chargeStatus = match ($stripePaymentIntent->type) {
                'payment_intent.succeeded' => 'succeeded',
                'payment_intent.payment_failed' => 'failed',
                default => throw new \Exception('Unhandled event type'),
            };
            $paymentIntentId = $stripePaymentIntent->data->object->id;
            // Retrieve the payment intent from the database, and saving it
            $paymentIntent = $this->paymentService->getByPaymentGatewayIntentId($paymentIntentId);
            $paymentIntent->charge_status = $chargeStatus;
            $paymentIntent->charge_id = $stripePaymentIntent->data->object->charges->data[0]->id;
            $paymentIntent->charge_description = $stripePaymentIntent->data->object->charges->data[0]->description;
            $paymentIntent->amount = $stripePaymentIntent->data->object->charges->data[0]->amount;
            $this->paymentService->update($paymentIntent);
            $stripeEvent = $this->paymentGatewayEventService->getByPaymentGatewayEventId($stripePaymentIntent->id);
            $stripeEvent->processed = true;
            $this->paymentGatewayEventService->update($stripeEvent);
            DB::connection('mysql')->commit();
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            throw $e;
        }
    }

    // TODO MVP: managing only if succeded
    public function manageSetupIntent(Event $stripeSetupIntent): void
    {
        try {
            DB::connection('mysql')->beginTransaction();

            // User id, saved before in the metadata
            $userId = $stripeSetupIntent->data->object->metadata->user_id;

            // Saving the payment method id
            $paymentMethodId = $stripeSetupIntent->data->object->payment_method;
            $paymentMethod = new UserPaymentMethod();
            $paymentMethod->user_id = $userId;
            $paymentMethod->payment_gateway_payment_method_id = $paymentMethodId;

            $this->paymentMethodService->insert($paymentMethod);

            // Updating the user with the default method
            $user = $this->userService->get($userId);
            $user->default_payment_method_id = $paymentMethod->id;
            $this->userService->update($user);
            $stripeEvent = $this->paymentGatewayEventService->getByPaymentGatewayEventId($stripeSetupIntent->id);
            $stripeEvent->processed = true;
            $this->paymentGatewayEventService->update($stripeEvent);
            DB::connection('mysql')->commit();
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            throw $e;
        }
    }
}
