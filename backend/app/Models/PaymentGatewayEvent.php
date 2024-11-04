<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGatewayEvent extends Model
{
    protected $table = 'payment_gateway_events';
    protected $connection = 'mysql';
}
