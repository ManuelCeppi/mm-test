<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use PDO;

interface BaseRepositoryInterface
{

    function insert(Model $modelToInsert): Model;

    function update(Model $modelToUpdate): Model;

    function get(int $id): ?Model;

    function getAll(int $limit, int $offset): Collection;

    function delete(int $id): void;

    function getTableName(): string;

    function getConnectionName(): string;

    function getTableBuilder(): QueryBuilder;

    function getPdo(bool $readInstance): PDO;
}
