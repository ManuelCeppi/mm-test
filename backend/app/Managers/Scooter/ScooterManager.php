<?php

declare(strict_types=1);

namespace App\Managers\Scooter;

use App\Http\Requests\Scooter\InsertScooterRequest;
use App\Http\Requests\Scooter\UpdateScooterRequest;
use App\Models\Scooter;
use App\Services\Scooter\ScooterService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScooterManager
{
    public function __construct(private readonly ScooterService $scooterService) {}

    public function getAll(int $limit, int $offset): Collection
    {
        return $this->scooterService->getAll($limit, $offset);
    }

    public function get(int $id): Scooter
    {
        $scooter = $this->scooterService->get($id);
        if (!$scooter) {
            throw new ModelNotFoundException('Scooter not found');
        }
        return $scooter;
    }

    public function insert(InsertScooterRequest $request): Scooter
    {
        $scooter = new Scooter();
        $scooter->fill($request->validated());
        return $this->scooterService->insert($scooter);
    }

    public function update(UpdateScooterRequest $request, int $id): Scooter
    {
        $scooter = $this->get($id);
        $scooter->fill($request->validated());
        return $this->scooterService->update($scooter);
    }

    public function delete(int $id): void
    {
        $this->scooterService->delete($id);
    }
}
