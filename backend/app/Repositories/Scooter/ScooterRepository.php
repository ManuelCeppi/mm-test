<?php

declare(strict_types=1);

namespace App\Repositories\Scooter;

use App\Models\Scooter;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Collection;

class ScooterRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Scooter::class);
    }

    public function getByUid(string $uid): ?Scooter
    {
        return $this->getEloquentBuilder()->where('uid', '=', $uid)->first();
    }

    public function getParkedScootersByStation(int $stationId): Collection
    {
        $eloquentBuilder = $this->getEloquentBuilder();

        $eloquentBuilder->where('current_station_id', '=', $stationId);

        return $eloquentBuilder->get();
    }
}
