<?php

declare(strict_types=1);

namespace App\Managers;

use App\Managers\Interfaces\CrudManagerInterface;

class ScooterManager implements CrudManagerInterface
{
    public function __construct(private readonly ScooterService $scooterService) {}

    public function get(int $scooterId): ?Scooter
    {
        return $this->scooterService->get($scooterId);
    }
}
