<?php

namespace Tests\Unit;

use App\Enums\ScooterStatus;
use App\Models\Scooter;
use App\Repositories\Scooter\ScooterRepository;
use App\Services\Scooter\ScooterService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\TestCase;

class ScooterUnitTest extends TestCase
{
    public function test_if_scooter_is_rentable(): void
    {
        $scooterRepository = $this->createMock(ScooterRepository::class);
        $scooterService = new ScooterService($scooterRepository);

        $scooter = new Scooter();
        $scooter->id = 1;
        $scooter->battery_level = 100;
        $scooter->status = ScooterStatus::AVAILABLE;

        $scooterRepository
            ->method('get')
            ->willReturn($scooter);

        $isRentable = $scooterService->checkIfIsRentable(1);
        $this->assertTrue($isRentable);
    }

    public function test_if_scooter_is_rentable_by_uid(): void
    {
        $scooterRepository = $this->createMock(ScooterRepository::class);
        $scooterService = new ScooterService($scooterRepository);

        $scooter = new Scooter();
        $scooter->id = 1;
        $scooter->uid = 'test_uid';
        $scooter->battery_level = 100;
        $scooter->status = ScooterStatus::AVAILABLE;

        $scooterRepository
            ->method('getByUid')
            ->willReturn($scooter);

        $isRentable = $scooterService->checkIfIsRentableByUid('test_uid');
        $this->assertTrue($isRentable);
    }

    public function test_if_scooter_is_not_rentable_due_to_battery_level(): void
    {
        $scooterRepository = $this->createMock(ScooterRepository::class);
        $scooterService = new ScooterService($scooterRepository);

        $scooter = new Scooter();
        $scooter->id = 1;
        $scooter->battery_level = 99.99;
        $scooter->status = ScooterStatus::AVAILABLE;

        $scooterRepository
            ->method('get')
            ->willReturn($scooter);

        $isRentable = $scooterService->checkIfIsRentable(1);
        $this->assertFalse($isRentable);
    }

    public function test_if_scooter_is_not_rentable_due_to_status(): void
    {
        $scooterRepository = $this->createMock(ScooterRepository::class);
        $scooterService = new ScooterService($scooterRepository);

        $scooter = new Scooter();
        $scooter->id = 1;
        $scooter->battery_level = 100;
        $scooter->status = ScooterStatus::RENTED;

        $scooterRepository
            ->method('get')
            ->willReturn($scooter);

        $isRentable = $scooterService->checkIfIsRentable(1);
        $this->assertFalse($isRentable);
    }

    public function test_if_scooter_is_rentable_ko(): void
    {
        $scooterRepository = $this->createMock(ScooterRepository::class);
        $scooterService = new ScooterService($scooterRepository);

        $this->expectException(ModelNotFoundException::class);

        $scooterService->checkIfIsRentable(1);
    }
}
