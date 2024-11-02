<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class StationController extends Controller
{
    public function __construct(private readonly StationController $stationManager) {}
}
