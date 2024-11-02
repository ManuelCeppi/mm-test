<?php

declare(strict_types=1);

namespace App\Managers\Scooter;

use App\Services\Scooter\ScooterService;

class ScooterManager
{
    public function __construct(private readonly ScooterService $scooterService) {}
}
