<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Repositories\Payment\PaymentGatewayEventRepository;
use App\Services\AbstractService;

class PaymentGatewayEventService extends AbstractService
{
    public function __construct(private readonly PaymentGatewayEventRepository $paymentGatewayEventRepository)
    {
        parent::__construct($paymentGatewayEventRepository);
    }

    public function getByPaymentGatewayEventId(string $paymentGatewayEventId)
    {
        return $this->paymentGatewayEventRepository->getByPaymentGatewayEventId($paymentGatewayEventId);
    }
}
