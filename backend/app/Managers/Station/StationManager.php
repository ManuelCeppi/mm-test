<?php

declare(strict_types=1);

namespace App\Managers\Station;

use App\Services\Station\StationService;

class StationManager
{
    public function __construct(private readonly StationService $stationService) {}
    
}
