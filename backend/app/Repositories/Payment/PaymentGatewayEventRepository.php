<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\PaymentGatewayEvent;
use App\Repositories\AbstractRepository;

class PaymentGatewayEventRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(PaymentGatewayEvent::class);
    }

    public function getByPaymentGatewayEventId(string $paymentGatewayEventId): ?PaymentGatewayEvent
    {
        $eq = $this->getEloquentBuilder();
        $eq->where('payment_gateway_event_id', $paymentGatewayEventId);
        return $eq->first();
    }
}
