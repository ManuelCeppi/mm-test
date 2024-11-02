<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case FAILED = 'failed';
    case SUCCEDED = 'succeded';
    case ABORTED = 'aborted';
}
