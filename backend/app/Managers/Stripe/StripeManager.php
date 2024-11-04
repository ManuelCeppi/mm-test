<?php

declare(strict_types=1);

namespace App\Managers\Stripe;

use App\Services\Payment\PaymentIntentService;
use App\Services\Payment\PaymentService;
use App\Services\Rental\RentalService;
use App\Services\Stripe\StripeApiService;
use Illuminate\Http\Request;
use Stripe\Event;

// Webhook manager
class StripeManager
{
    public function __construct(
        private readonly PaymentIntentService $paymentService,
        private readonly RentalService $rentalService
    ) {}

    public function managePaymentIntent(Event $stripePaymentIntent): void
    {
        // Rertieve the payment intent from the event
        try {
            $paymentIntent = $stripePaymentIntent->data->object;

            // Retrieve the payment intent id
            $paymentIntentId = $paymentIntent->id;
        } catch (\Exception $e) {
            throw new \Exception('Error while retrieving the payment intent');
        }
    }
}
