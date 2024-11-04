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
    ) {}

    public function managePaymentIntent(Event $stripePaymentIntent): void
    {
        // Rertieve the payment intent from the event
        try {
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
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
