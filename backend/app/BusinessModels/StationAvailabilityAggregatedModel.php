<?php

declare(strict_types=1);

namespace App\BusinessModels;

class StationAvailabilityAggregatedModel
{
    public function __construct(
        public readonly string $name,
        public readonly string $city,
        public readonly string $street,
        public readonly int $number,
        public readonly string $countryCode,
        public readonly int $maximumCapacity,
        public readonly int $availableSpots
    ) {}
}
