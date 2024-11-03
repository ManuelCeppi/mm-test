<?php

declare(strict_types=1);

namespace App\Services\Rental;

use App\Repositories\Interfaces\RentalRepositoryInterface;
use App\Services\AbstractService;
use Illuminate\Database\Eloquent\Collection;

class RentalService extends AbstractService
{
    public function __construct(private readonly RentalRepositoryInterface $rentalRepository)
    {
        parent::__construct($rentalRepository);
    }
    public function getOngoingRentals(int $limit = 10, int $offset = 0): Collection
    {
        $ongoingRentals = $this->rentalRepository->getOngoingRentals(
            $limit,
            $offset
        );

        return $ongoingRentals;
    }

    public function getRentalsHistoryByUser(int $userId, int $limit = 10, int $offset = 0): Collection
    {
        $rentalsByUser = $this->rentalRepository->getRentalsHistoryByUser(
            $userId,
            $limit,
            $offset
        );

        return $rentalsByUser;
    }
}
