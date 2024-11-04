<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Rental\EndRentalRequest;
use App\Managers\Rental\RentalManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentalController extends Controller
{
    public function __construct(private readonly RentalManager $rentalManager) {}

    public function getOngoingRentals(Request $request): Response
    {
        $limit = intval($request->query('limit') ?? 10);
        $offset = intval($request->query('offset') ?? 0);
        $rentals = $this->rentalManager->getOngoingRentals($limit, $offset);
        return response(['rentals' => $rentals], 200);
    }

    public function getRentalsHistoryByUser(Request $request, int $userId): Response
    {
        $limit = intval($request->query('limit') ?? 10);
        $offset = intval($request->query('offset') ?? 0);
        $rentals = $this->rentalManager->getRentalsHistoryByUser($userId, $limit, $offset);
        return response(['rentals' => $rentals], 200);
    }

    public function getAll(Request $request): Response
    {
        $limit = intval($request->query('limit') ?? 10);
        $offset = intval($request->query('offset') ?? 0);
        $rentals = $this->rentalManager->getAll($limit, $offset);
        return response(['rentals' => $rentals], 200);
    }

    public function startRental(Request $request, string $scooterUid): Response
    {
        $rental = $this->rentalManager->startRental($scooterUid);
        return response(['rental' => $rental], 201);
    }

    public function endRental(EndRentalRequest $request, string $scooterUid, int $rentalId): Response
    {
        $endStationId = $request->input('station_id');
        $batteryLevel = $request->input('battery_level');

        $rental = $this->rentalManager->endRental(
            $scooterUid,
            $rentalId,
            $endStationId,
            $batteryLevel,
        );
        return response(['rental' => $rental], 200);
    }

    public function get(int $id): Response
    {
        $rental = $this->rentalManager->get($id);
        return response(['rental' => $rental], 200);
    }
}
