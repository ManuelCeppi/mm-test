<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Tests\TestCase;

class RentalControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->markTestSkipped('Unable to test with the stripe sdk not commented; So skipping the test.');
    }

    public function test_start_rental(): void
    {
        $scooterUid = "04A1B2C3D4E5F6";

        $user = new User();
        $user->id = 3;
        $user->default_payment_method_id = 2;
        // The guard is api: mm-token is the name of the driver that the guard is using
        $response = $this->actingAs($user, 'api')->post("/api/mm/scooters/{$scooterUid}/rent/start");

        $response->assertJsonStructure(["error", "errorEx", "result" => ['rental']]);
        $response->assertStatus(201);
    }

    public function test_end_rental(): void
    {
        $scooterUid = "04A1B2C3D4E5F6";
        $rentalId = 1;

        $user = new User();
        $user->id = 1;
        $user->default_payment_method_id = 1;
        // The guard is api: mm-token is the name of the driver that the guard is using
        $batteryLevel = Factory::create()->randomFloat(2, 0, 100);
        $stationId = 1;
        $response = $this->actingAs($user, 'api')->post("/api/mm/scooters/{$scooterUid}/{$rentalId}/rent/end", [
            'battery_level' => $batteryLevel,
            'station_id' => $stationId
        ]);

        $response->assertJsonStructure(["error", "errorEx", "result" => ['rental']]);
        $response->assertStatus(200);
    }
}