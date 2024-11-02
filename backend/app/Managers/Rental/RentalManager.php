<?php

declare(strict_types=1);

namespace App\Managers\Rentals;

use App\Services\Rental\RentalService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RentalManager
{
    public function __construct(private readonly RentalService $rentalService) {}

    public function getRentalsHistoryByUser(int $userId, int $limit = 10, int $offset = 0): Collection
    {
        $rentals = $this->rentalService->getRentalsHistoryByUser(
            $userId,
            $limit,
            $offset
        );

        return $rentals;
    }

    public function getOngoingRentals(int $limit = 10, int $offset = 0): Collection
    {
        $rentals = $this->rentalService->getOngoingRentals(
            $limit,
            $offset
        );

        return $rentals;
    }

    public function get(int $id)
    {
        $rental = $this->rentalService->get($id);
        if (!$rental) {
            throw new ModelNotFoundException('Rental not found');
        }
        return $rental;
    }

    public function getAll(int $limit = 10, int $offset = 0): Collection
    {
        return $this->rentalService->getAll($limit, $offset);
    }
}
