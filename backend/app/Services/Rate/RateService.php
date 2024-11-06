<?php


declare(strict_types=1);

namespace App\Services\Rate;

use App\Models\Rate;
use App\Models\Rental;
use App\Repositories\Rate\RateRepository;
use App\Services\AbstractService;
use Illuminate\Support\Facades\Log;

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

    public function evaluateRentalAmountByDurationInSeconds(Rental $rental, int $durationInSeconds): float
    {
        // Retrieving rate
        $rate = $this->get($rental->rate_id);
        $totalAmount = $rate->base_amount + ($durationInSeconds * $rate->amount_per_second);
        return $totalAmount;
    }
}
