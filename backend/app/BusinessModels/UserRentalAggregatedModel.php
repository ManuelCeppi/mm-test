<?php

declare(strict_types=1);

namespace App\BusinessModels;

use App\Enums\RentalStatus;
use DateTimeInterface;

class UserRentalAggregatedModel
{
    public function __construct(
        public readonly int $userId,
        public readonly int $rentalId,
        public readonly int $startingStationId,
        public readonly ?int $endingStationId,
        public readonly int $scooterId,
        public readonly string $name,
        public readonly string $surname,
        public readonly string $email,
        public readonly string $phoneNumber,
        public readonly DateTimeInterface $rentalStartDate,
        public readonly ?DateTimeInterface $rentalEndDate,
        public readonly RentalStatus $rentalStatus,
        public readonly ?float $amount,
        public readonly ?int $durationSeconds,
        public readonly string $scooterName,
        public readonly string $startingStationName,
        public readonly ?string $endingStationName,
    ) {}
}
