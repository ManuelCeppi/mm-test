<?php

declare(strict_types=1);

namespace App\Repositories\Rental;

use App\Models\Rental;
use App\Repositories\AbstractRepository;

class RentalRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Rental::class);
    }
}
