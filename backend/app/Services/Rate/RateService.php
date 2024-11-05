<?php


declare(strict_types=1);

namespace App\Services\Rate;

use App\Models\Rate;
use App\Repositories\Payment\RateRepository;
use App\Services\AbstractService;

class RateService extends AbstractService
{
    public function __construct(private readonly RateRepository $rateRepository)
    {
        parent::__construct($rateRepository);
    }

    public function getActualValidRate(): ?Rate
    {
        return $this->rateRepository->getActualValidRate();
    }
}
