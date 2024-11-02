<?php

declare(strict_types=1);

namespace App\Repositories\Station;

use App\Models\Station;
use App\Repositories\AbstractRepository;

class StationRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct(Station::class);
    }
}
