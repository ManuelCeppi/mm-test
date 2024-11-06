<?php

namespace Tests\Unit;

use App\Models\Scooter;
use App\Models\Station;
use App\Repositories\Scooter\ScooterRepository;
use App\Repositories\Station\StationRepository;
use App\Services\Station\StationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\TestCase;

class StationUnitTest extends TestCase
{
    public function test_station_has_remaining_capability(): void
    {
        $stationRepository = $this->createMock(StationRepository::class);
        $scooterRepository = $this->createMock(ScooterRepository::class);
        $stationService = new StationService(
            $stationRepository,
            $scooterRepository
        );

        $station = new Station();
        $station->id = 1;
        $station->maximum_capacity = 10;
        $stationRepository
            ->method('get')
            ->willReturn($station);
        $scooterRepository
            ->method('getParkedScootersByStation')
            ->willReturn(collect([
                new Scooter(),
                new Scooter(),
                new Scooter(),
            ]));

        $remainingCapacity = $stationService->getRemainingCapacity(1);
        $this->assertEquals(7, $remainingCapacity);
    }

    public function test_station_has_remaining_capability_ko(): void
    {
        $stationRepository = $this->createMock(StationRepository::class);
        $scooterRepository = $this->createMock(ScooterRepository::class);
        $stationService = new StationService(
            $stationRepository,
            $scooterRepository
        );

        $station = new Station();
        $station->id = 1;
        $station->maximum_capacity = 10;
        $stationRepository
            ->method('get')
            ->willReturn(null);
        $scooterRepository
            ->method('getParkedScootersByStation')
            ->willReturn(collect([
                new Scooter(),
                new Scooter(),
                new Scooter(),
            ]));

        $this->expectException(ModelNotFoundException::class);
        $stationService->getRemainingCapacity(1);
    }
}
