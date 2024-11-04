<?php

declare(strict_types=1);

namespace App\Services\Stripe;

use Stripe\Customer;
use Stripe\PaymentIntent;
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

    public function createPayment(array $paymentIntentPayload): PaymentIntent
    {
        $intent = $this->client->paymentIntents->create($paymentIntentPayload);
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
}
