<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Managers\Rentals\RentalManager;

class RentalController extends Controller
{
    public function __construct(private readonly RentalManager $rentalManager) {}
}
