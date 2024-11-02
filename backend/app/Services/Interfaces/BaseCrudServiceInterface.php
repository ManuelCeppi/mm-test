<?php

namespace  App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseCrudServiceInterface
{
    function getAll(int $limit, int $offset): Collection;
    function insert($model): Model;
    function delete(int $id): void;
    function get(int $id): ?Model;
    function update($model): Model;
}
