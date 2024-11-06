<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationControllerTest extends TestCase
{
    public function test_list_stations(): void
    {
        $user = new User();
        $user->id = 1;

        $response = $this->actingAs($user, 'api')->get('/internal/mm/stations');

        $response->assertJsonStructure(["error", "errorEx", "result" => ['stations']]);
        $response->assertStatus(200);
    }

    public function test_get_station(): void
    {
        $stationId = 1;
        $user = new User();
        $user->id = 1;
        $response = $this->actingAs($user, 'api')->get("/internal/mm/stations/{$stationId}");

        $response->assertJsonStructure(["error", "errorEx", "result" => ['station']]);
        $response->assertStatus(200);
    }

    public function test_update_station(): void
    {
        $stationId = 1;
        $user = new User();
        $user->id = 1;
        $response = $this->actingAs($user, 'api')->patch("/internal/mm/stations/{$stationId}", [
            'name' => 'Station 1',
        ]);

        $response->assertStatus(200);
    }

    // TODO Other tests with user that cant access the internal APIs
}
