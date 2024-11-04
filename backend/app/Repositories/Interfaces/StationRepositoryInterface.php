<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface StationRepositoryInterface extends BaseRepositoryInterface
{
    function getStationAvailabilities(int $limit, int $offset): Collection;
}
