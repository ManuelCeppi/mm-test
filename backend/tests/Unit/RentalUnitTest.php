<?php

namespace Tests\Unit;

use App\Models\Rate;
use App\Models\Rental;
use App\Repositories\Rate\RateRepository;
use App\Services\Rate\RateService;
use PHPUnit\Framework\TestCase;

class RentalUnitTest extends TestCase
{
    // Test if the rental amount is evaluated correctly, so if the service function works as expected.
    public function test_evaluate_rental_amount_by_duration_in_seconds(): void
    {
        $rateRepository = $this->createMock(RateRepository::class);
        $rateService = new RateService($rateRepository);
        $rate = new Rate();
        $rate->base_amount = 10;
        $rate->amount_per_second = 0.1;
        // Mock the rate repository get method to return the rate object
        $rateRepository
            ->method('get')
            ->willReturn($rate);
        $rental = new Rental();
        $rental->rate_id = 1;
        $durationInSeconds = 100;
        $totalAmount = $rateService->evaluateRentalAmountByDurationInSeconds($rental, $durationInSeconds);
        $this->assertEquals(20, $totalAmount);
    }
}
