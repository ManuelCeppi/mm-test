<?php

declare(strict_types=1);

namespace App\BusinessModels;

use DateTimeInterface;

class OngoingRentalsAggregatedModel
{
    public function __construct(
        public readonly int $rentalId,
        public readonly int $scooterId,
        public readonly int $startingStationId,
        public readonly string $startingStationName,
        public readonly DateTimeInterface $startingRentalDate,
        public readonly string $scooterName,
        public readonly string $userName,
        public readonly string $email,
    ) {}
}
