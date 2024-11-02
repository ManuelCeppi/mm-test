<?php

declare(strict_types=1);

namespace App\Repositories\Scooter;

use App\Models\Scooter;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class ScooterRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Scooter::class);
    }

    public function getParkedScootersByStation(int $stationId): Collection
    {
        $eloquentBuilder = $this->getEloquentBuilder();

        $eloquentBuilder->where('current_station_id', '=', $stationId);

        return $eloquentBuilder->get();
    }
}
