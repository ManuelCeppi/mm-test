<?php

declare(strict_types=1);

namespace App\Services\Stripe;

use Illuminate\Support\Facades\App;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeApiService
{
    private StripeClient $client;
    public function __construct()
    {
        $client = new StripeClient([""]);
    }

    public function createPayment() {}

    public function createCustomer() {}

    public function getCustomer() {}

    public function verifyCustomer() {}
}
