<?php

namespace App\Enums;

enum ScooterStatus: string
{
    case AVAILABLE = 'available';
    case UNAVAILABLE = 'unavailable';
    case RENTED = 'rented';
    case FAULTED = 'faulted';
    case RECHARGING = 'recharging';
}
