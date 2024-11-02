<?php

namespace App\Enums;

enum ScooterStatus: string
{
    case AVAILABLE = 'available';
    case UNAVAILABLE = 'unavailable';
    case FAULTED = 'faulted';
}
