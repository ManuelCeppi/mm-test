<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Repositories\Payment\PaymentRepository;
use App\Services\AbstractService;

class PaymentIntentService extends AbstractService
{
    public function __construct(private readonly PaymentRepository $paymentIntentRepository)
    {
        parent::__construct($paymentIntentRepository);
    }

    public function getByPaymentGatewayIntentId(string $paymentGatewayIntentId)
    {
        return $this->paymentIntentRepository->getByPaymentGatewayIntentId($paymentGatewayIntentId);
    }
}
