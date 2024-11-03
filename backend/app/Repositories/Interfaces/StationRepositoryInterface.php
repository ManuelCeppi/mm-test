<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface StationRepositoryInterface extends BaseRepositoryInterface
{
    function getStationAvailabilities(int $limit, int $offset): Collection;
}
