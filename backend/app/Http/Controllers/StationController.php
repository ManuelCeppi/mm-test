<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Station\InsertStationRequest;
use App\Http\Requests\Station\UpdateStationRequest;
use App\Managers\Station\StationManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StationController extends Controller
{
    public function __construct(private readonly StationManager $stationManager) {}

    public function getStationsAvailabilities(Request $request): Response
    {
        $limit = $request->query('limit') ?? 10;
        $offset = $request->query('offset') ?? 0;
        $stationsAvailabilities = $this->stationManager->getStationsAvailabilities($limit, $offset);
        return response(['stationsAvailabilities' => $stationsAvailabilities], 200);
    }

    public function getAll(Request $request): Response
    {
        $limit = $request->query('limit') ?? 10;
        $offset = $request->query('offset') ?? 0;
        $stations = $this->stationManager->getAll($limit, $offset);
        return response(['stations' => $stations], 200);
    }

    public function get(Request $request, int $id): Response
    {
        $station = $this->stationManager->get($id);
        return response(['station' => $station], 200);
    }

    public function insert(InsertStationRequest $request): Response
    {
        $station = $this->stationManager->insert($request);
        return response(['station' => $station], 201);
    }

    public function update(UpdateStationRequest $request, int $id): Response
    {
        $station = $this->stationManager->update($request, $id);
        return response(['station' => $station], 200);
    }

    public function delete(int $id): Response
    {
        $this->stationManager->delete($id);
        return response([], 204);
    }
}
