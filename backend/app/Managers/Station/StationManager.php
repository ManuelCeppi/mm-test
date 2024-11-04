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

    public function insert(InsertStationRequest $station): Station
    {
        return $this->stationService->insert($station);
    }

    public function update(UpdateStationRequest $station): Station
    {
        $station = $this->get($station->id);
        $station->fill($station->validated());
        return $this->stationService->update($station);
    }

    public function delete(int $id): void
    {
        $this->stationService->delete($id);
    }
}
