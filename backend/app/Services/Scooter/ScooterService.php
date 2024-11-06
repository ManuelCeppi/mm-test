<?php

declare(strict_types=1);

namespace App\Services\Scooter;

use App\Enums\ScooterStatus;
use App\Models\Scooter;
use App\Repositories\Scooter\ScooterRepository;
use App\Services\AbstractService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ScooterService extends AbstractService
{
    public function __construct(private readonly ScooterRepository $scooterRepository)
    {
        parent::__construct($scooterRepository);
    }

    public function getByUid(string $uid): ?Scooter
    {
        return $this->scooterRepository->getByUid($uid);
    }

    public function checkIfIsRentable(int $scooterId): bool
    {
        // Get scooter
        $scooter = $this->get($scooterId);
        if (!$scooter) {
            throw new ModelNotFoundException("Scooter with id {$scooterId} not found!");
        }
        return $this->checkBatteryLevelAndStatus($scooter);
    }

    public function checkIfIsRentableByUid(string $uid): bool
    {
        // Get scooter
        $scooter = $this->getByUid($uid);
        if (!$scooter) {
            throw new ModelNotFoundException("Scooter with uid {$uid} not found!");
        }

        return $this->checkBatteryLevelAndStatus($scooter);
    }

    public function checkBatteryLevelAndStatus(Scooter $scooter): bool
    {
        $isFullyCharged = floor($scooter->battery_level) == 100;
        $isAvailable = $scooter->status === ScooterStatus::AVAILABLE;
        return $isFullyCharged && $isAvailable;
    }
}
