<?php

declare(strict_types=1);

namespace App\Services\Scooter;

use App\Enums\ScooterStatus;
use App\Repositories\Scooter\ScooterRepository;
use App\Services\AbstractService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScooterService extends AbstractService
{
    public function __construct(private readonly ScooterRepository $scooterRepository)
    {
        parent::__construct($scooterRepository);
    }

    public function checkIfIsRentable(int $scooterId): bool
    {
        // Get scooter
        $scooter = $this->get($scooterId);
        if (!$scooter) {
            throw new ModelNotFoundException("Scooter with id {$scooterId} not found!");
        }

        $isFullyCharged = $scooter->battery_status === 100;
        $isAvailable = $scooter->status === ScooterStatus::AVAILABLE;

        return $isFullyCharged && $isAvailable;
    }
}
