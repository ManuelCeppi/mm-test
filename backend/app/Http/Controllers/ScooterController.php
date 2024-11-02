<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Managers\Scooter\ScooterManager;

class ScooterController extends Controller
{
    public function __construct(private readonly ScooterManager $scooterManager) {}
}
