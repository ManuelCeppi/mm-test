<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Payment;
use App\Repositories\AbstractRepository;

class PaymentRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Payment::class);
    }

    public function getByPaymentGatewayIntentId(string $paymentGatewayIntentId): ?Payment
    {
        $eq = $this->getEloquentBuilder();
        $eq->where('payment_gateway_intent_id', $paymentGatewayIntentId);
        return $eq->first();
    }
}
