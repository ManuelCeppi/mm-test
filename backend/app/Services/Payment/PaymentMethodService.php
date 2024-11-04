<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Repositories\Payment\PaymentMethodRepository;
use App\Services\AbstractService;

class PaymentMethodService extends AbstractService
{
    public function __construct(private readonly PaymentMethodRepository $paymentMethodRepository)
    {
        parent::__construct($paymentMethodRepository);
    }
}
