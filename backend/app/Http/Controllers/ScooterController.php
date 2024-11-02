<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Scooter\InsertScooterRequest;
use App\Http\Requests\Scooter\UpdateScooterRequest;
use App\Managers\Scooter\ScooterManager;

class ScooterController extends Controller
{
    public function __construct(private readonly ScooterManager $scooterManager) {}

    public function getAll()
    {
        $scooters = $this->scooterManager->getAll(10, 0);
        return response(["scooters" => $scooters], 200);
    }

    public function get(int $id)
    {
        $scooter = $this->scooterManager->get($id);
        return response(["scooter" => $scooter], 200);
    }

    public function insert(InsertScooterRequest $request)
    {
        $scooter = $this->scooterManager->insert($request);
        return response(["scooter" => $scooter], 201);
    }

    public function update(UpdateScooterRequest $request, int $id)
    {
        $scooter = $this->scooterManager->update($request, $id);
        return response(["scooter" => $scooter], 200);
    }

    public function delete(int $id)
    {
        $this->scooterManager->delete($id);
        return response([], 204);
    }
}
