<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Services\Interfaces\BaseCrudServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractService implements BaseCrudServiceInterface
{
    public function __construct(private readonly BaseRepositoryInterface $modelRepository) {}

    public function getAll(int $limit = 10, int $offset = 0): Collection
    {
        return $this->modelRepository->getAll($limit, $offset);
    }

    public function get(int $id): ?Model
    {
        return $this->modelRepository->get($id);
    }

    public function insert($model): Model
    {
        $insertedScooter = $this->modelRepository->insert($model);
        return $insertedScooter;
    }

    public function update($model): Model
    {
        return $this->modelRepository->update($model);
    }

    public function delete(int $id): void
    {
        $this->modelRepository->delete($id);
    }
}
