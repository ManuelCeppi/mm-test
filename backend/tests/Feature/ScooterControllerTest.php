<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ScooterControllerTest extends TestCase
{
    public function test_list_scooters(): void
    {
        $user = new User();
        $user->id = 1;

        $response = $this->actingAs($user, 'api')->get('/internal/mm/scooters');

        $response->assertJsonStructure(["error", "errorEx", "result" => ['scooters']]);
        $response->assertStatus(200);
    }

    public function test_get_scooter(): void
    {
        $scooterId = 1;
        $user = new User();
        $user->id = 1;
        $response = $this->actingAs($user, 'api')->get("/internal/mm/scooters/{$scooterId}");

        $response->assertJsonStructure(["error", "errorEx", "result" => ['scooter']]);
        $response->assertStatus(200);
    }

    public function test_update_scooter(): void
    {
        $scooterId = 1;
        $user = new User();
        $user->id = 1;

        $response = $this->actingAs($user, 'api')->patch("/internal/mm/scooters/{$scooterId}", [
            'name' => 'Xiaomi M365',
        ]);

        // $response->assertJsonStructure(["error", "errorEx", "result" => ['scooter']]);
        $response->assertStatus(200);
    }

    // TODO Other tests with user that cant access the internal APIs
}
