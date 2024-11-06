<?php

declare(strict_types=1);

namespace App\Repositories\Rate;

use App\Models\Rate;
use App\Repositories\AbstractRepository;

class RateRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Rate::class);
    }

    public function getActualValidRate(): ?Rate
    {
        $eq = $this->getEloquentBuilder();
        $now = now('UTC');
        $eq->where('valid_from', '<=', $now);
        $eq->where('valid_to', '>=', $now)
            ->orWhereNull('valid_to');
        return $eq->first();
    }
}
