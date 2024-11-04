<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Scooter\InsertScooterRequest;
use App\Http\Requests\Scooter\UpdateScooterRequest;
use App\Managers\Scooter\ScooterManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ScooterController extends Controller
{
    public function __construct(private readonly ScooterManager $scooterManager) {}

    public function getAll(Request $request): Response
    {
        $limit = intval($request->query("limit", 10));
        $offset = intval($request->query("offset", 0));
        $scooters = $this->scooterManager->getAll($limit, $offset);
        return response(["scooters" => $scooters], 200);
    }

    public function get(int $id): Response
    {
        $scooter = $this->scooterManager->get($id);
        return response(["scooter" => $scooter], 200);
    }

    public function insert(InsertScooterRequest $request): Response
    {
        $scooter = $this->scooterManager->insert($request);
        return response(["scooter" => $scooter], 201);
    }

    public function update(UpdateScooterRequest $request, int $id): Response
    {
        $scooter = $this->scooterManager->update($request, $id);
        return response(["scooter" => $scooter], 200);
    }

    public function delete(int $id): Response
    {
        $this->scooterManager->delete($id);
        return response([], 204);
    }
}
