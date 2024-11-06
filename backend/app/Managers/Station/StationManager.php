<?php

declare(strict_types=1);

namespace App\Managers\Station;

use App\Http\Requests\Station\InsertStationRequest;
use App\Http\Requests\Station\UpdateStationRequest;
use App\Models\Station;
use App\Services\Station\StationService;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StationManager
{
    public function __construct(private readonly StationService $stationService) {}

    public function getStationsAvailabilities(int $limit, int $offset): Collection
    {
        return $this->stationService->getStationsAvailabilities($limit, $offset);
    }

    public function getAll(int $limit, int $offset): Collection
    {
        return $this->stationService->getAll($limit, $offset);
    }

    public function get(int $id): Station
    {
        $station = $this->stationService->get($id);
        if (!$station) {
            throw new ModelNotFoundException('Station not found');
        }
        return $station;
    }

    public function insert(InsertStationRequest $request): Station
    {
        $station = new Station();
        $station->fill($request->validated());
        return $this->stationService->insert($station);
    }

    public function update(UpdateStationRequest $request, int $id): Station
    {
        $station = $this->get($id);
        if (!$station) {
            throw new ModelNotFoundException('Station not found');
        }
        $station->fill($request->validated());
        return $this->stationService->update($station);
    }

    public function delete(int $id): void
    {
        // Check if the station exists
        $this->get($id);
        // Check if it has associated scooters
        $parkedScooters = $this->stationService->getParkedScooters($id);
        if ($parkedScooters->count() > 0) {
            throw new \Exception('Station has parked scooters');
        }
        // TODO Ofcourse, there are more checks to be done here, like rentals, etc.
        $this->stationService->delete($id);
    }
}
