<?php

declare(strict_types=1);

namespace App\Services\Station;

use App\Repositories\Scooter\ScooterRepository;
use App\Repositories\Station\StationRepository;
use App\Services\AbstractService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StationService extends AbstractService
{
    public function __construct(
        private readonly StationRepository $stationRepository,
        private readonly ScooterRepository $scooterRepository
    ) {
        parent::__construct($stationRepository);
    }

    public function getParkedScooters(int $stationId): Collection
    {
        $parkedScootersCollection = $this->scooterRepository->getParkedScootersByStation($stationId);
        return $parkedScootersCollection;
    }

    public function getRemainingCapacity(int $stationId): int
    {
        // Getting station
        $station = $this->get($stationId);
        if (!$station) {
            throw new ModelNotFoundException("Station with id {$stationId} not found!");
        }

        // Getting parked scooters
        $parkedScooters = $this->getParkedScooters($stationId);
        return $station->maximum_capacity - $parkedScooters->count();
    }
}
