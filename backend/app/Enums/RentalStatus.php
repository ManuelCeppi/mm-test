<?php

namespace App\Enums;

enum RentalStatus: string
{
    case STARTING = 'starting';
    case ONGOING = 'ongoing';
    case FINISHED = 'finished';
}
