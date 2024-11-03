<?php

declare(strict_types=1);

namespace App\Managers\Payment;

use App\Services\Payment\PaymentService;

class PaymentManager
{
    public function __construct(private readonly PaymentService $paymentService) {}
}