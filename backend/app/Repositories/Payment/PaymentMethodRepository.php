<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\UserPaymentMethod;
use App\Repositories\AbstractRepository;

class PaymentMethodRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(UserPaymentMethod::class);
    }
}
