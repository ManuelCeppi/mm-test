<?php

declare(strict_types=1);

namespace App\Managers\Rentals;

use App\Services\Rental\RentalService;

class RentalManager
{
    public function __construct(private readonly RentalService $rentalService) {}
}
