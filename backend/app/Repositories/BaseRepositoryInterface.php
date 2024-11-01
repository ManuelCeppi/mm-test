<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\BaseModelInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use PDO;

interface BaseRepositoryInterface
{

    function insert(BaseModelInterface $modelToInsert): BaseModelInterface;

    function update(BaseModelInterface $modelToUpdate): BaseModelInterface;

    function get(string $uuid): ?Model;

    function delete(string $uuid): void;

    function getTableName(): string;

    function getConnectionName(): string;

    function getTableBuilder(): QueryBuilder;

    function getPdo(bool $readInstance): PDO;
}