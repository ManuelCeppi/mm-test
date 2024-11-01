<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\BaseModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;

abstract class AbstractRepository implements BaseRepositoryInterface
{
    private string $tableName;

    public function __construct(private readonly string $modelName)
    {
        $instance = new ($this->modelName)();
        $this->tableName = $instance->getTable();
    }

    public function getPdo(bool $readInstance): PDO
    {
        $connectionName = $readInstance ? $this->getConnectionName() . '::read' : $this->getConnectionName();
        return DB::connection($connectionName)->getPdo();
    }

    public function getEloquentBuilder(): Builder
    {
        return ($this->modelName)::query();
    }

    public function getConnectionName(): string
    {
        /** @var Model $instance */
        $instance = new ($this->modelName)();
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

    public function insert(BaseModelInterface $modelToInsert): BaseModelInterface
    {
        $modelToInsert->save();
        return $modelToInsert;
    }

    public function get(string $uuid): ?Model
    {
        // Get eloquent builder
        $model = $this->getEloquentBuilder()->where('uuid', '=', $uuid)->first();
        return $model;
    }

    public function update(BaseModelInterface $modelToUpdate): BaseModelInterface
    {
        $modelToUpdate->save();
        return $modelToUpdate;
    }

    public function delete(string $uuid): void
    {
        $this->getEloquentBuilder()->where('uuid', '=', $uuid)->delete();
    }
}