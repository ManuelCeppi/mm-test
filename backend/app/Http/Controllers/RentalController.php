<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Managers\Rentals\RentalManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentalController extends Controller
{
    public function __construct(private readonly RentalManager $rentalManager) {}

    public function getOngoingRentals(Request $request): Response
    {
        $limit = $request->query('limit') ?? 10;
        $offset = $request->query('offset') ?? 0;
        $rentals = $this->rentalManager->getOngoingRentals($limit, $offset);
        return response(['rentals' => $rentals], 200);
    }

    public function getRentalsHistoryByUser(Request $request): Response
    {
        $limit = $request->query('limit') ?? 10;
        $offset = $request->query('offset') ?? 0;
        $rentals = $this->rentalManager->getRentalsHistoryByUser($limit, $offset);
        return response(['rentals' => $rentals], 200);
    }

    public function getAll(Request $request): Response
    {
        $limit = $request->query('limit') ?? 10;
        $offset = $request->query('offset') ?? 0;
        $rentals = $this->rentalManager->getAll($limit, $offset);
        return response(['rentals' => $rentals], 200);
    }

    public function startRental(Request $request, string $scooterUid): Response
    {
        $rental = $this->rentalManager->startRental($scooterId);
        return response(['rental' => $rental], 200);
    }

    public function endRental(Request $request, string $scooterUid, int $rentalId): Response
    {
        $rental = $this->rentalManager->endRental($scooterUid, $rentalId);
        return response(['rental' => $rental], 200);
    }
}
