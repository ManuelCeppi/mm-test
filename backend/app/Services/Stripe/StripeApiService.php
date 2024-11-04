<?php

declare(strict_types=1);

namespace App\Services\Stripe;

use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\SetupIntent;
use Stripe\StripeClient;

class StripeApiService
{
    private StripeClient $client;
    public function __construct()
    {
        // TODO Simplified: with stripe you can manage different key/live mode combinations, this way you can test production with test keys and data, 
        // so that it points to stripe test environment, or production (livemode = false);
        // Here i'm just putting a SK get from env, so you just discriminate the key by the environment itself.
        $this->client = new StripeClient(env("STRIPE_SK"));
    }

    public function createPaymentIntent(array $paymentIntentPayload): PaymentIntent
    {
        $intent = $this->client->paymentIntents->create($paymentIntentPayload);
        return $intent;
    }

    public function getPaymentIntent(string $paymentId): PaymentIntent
    {
        $intent = $this->client->paymentIntents->retrieve($paymentId);
        return $intent;
    }

    public function capturePaymentIntent(string $paymentId, $totalAmount = null): PaymentIntent
    {
        // If total amount is null, the assumption is that the initial amount is the total amount that is being captured
        if ($totalAmount) {
            $this->client->paymentIntents->update($paymentId, ['amount' => $totalAmount]);
        }
        $intent = $this->client->paymentIntents->capture($paymentId);
        return $intent;
    }

    public function createCustomer(array $customerPayload): Customer
    {
        $customer = $this->client->customers->create($customerPayload);
        return $customer;
    }

    public function getCustomer(string $customerId): Customer
    {
        $customer = $this->client->customers->retrieve($customerId);
        return $customer;
    }

    /**
     * Create a SetupIntent: the stripe object that will be used to confirm and store a payment method for a customer.
     * @param array $setupIntentPayload
     */
    public function createSetupIntent(array $setupIntentPayload): SetupIntent
    {
        $setupIntent = $this->client->setupIntents->create($setupIntentPayload);
        return $setupIntent;
    }
}
