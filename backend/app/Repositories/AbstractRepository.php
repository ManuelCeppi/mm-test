<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PDO;

abstract class AbstractRepository implements BaseRepositoryInterface
{
    private string $tableName;

    public function __construct(private readonly string $modelName)
    {
        $instance = new $this->modelName;
        $this->tableName = $instance->getTable();
    }

    /**
     * @param bool $readInstance Choose whether to get the read instance connection or the read/write
     */
    public function getPdo(bool $readInstance): PDO
    {
        $connectionName = $readInstance ? $this->getConnectionName() . '::read' : $this->getConnectionName();
        return DB::connection($connectionName)->getPdo();
    }

    public function getEloquentBuilder(): Builder
    {
        $instance = new $this->modelName();
        return $instance::query();
    }

    public function getConnectionName(): string
    {
        /** @var Model $instance */
        $instance = new $this->modelName();

        return $instance->getConnectionName();
    }

    public function getTableBuilder(): QueryBuilder
    {
        $table = $this->getTableName();

        return DB::connection($this->getConnectionName())->table($table);
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function insert(Model $modelToInsert): Model
    {
        $modelToInsert->save();
        return $modelToInsert;
    }

    public function get(int $id): ?Model
    {
        // Get eloquent builder
        $model = $this->getEloquentBuilder()->where('id', '=', $id)->first();
        return $model;
    }

    public function getAll(int $limit, int $offset): Collection
    {
        return collect($this->getTableBuilder()
            ->limit($limit)
            ->offset($offset)
            ->get());
    }

    public function update(Model $modelToUpdate): Model
    {
        $modelToUpdate->save();
        return $modelToUpdate;
    }

    public function delete(int $id): void
    {
        $this->getEloquentBuilder()->where('id', '=', $id)->delete();
    }
}
