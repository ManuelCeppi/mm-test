<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface RentalRepositoryInterface extends BaseRepositoryInterface
{
    function getOngoingRentals(int $limit, int $offset): Collection;

    function getRentalsHistoryByUser(int $userId, int $limit, int $offset): Collection;
}
