<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_healthcheck(): void
    {
        $response = $this->get('/api/mm/healthcheck');

        $response->assertStatus(200);
    }

    public function test_login(): void
    {
        $response = $this->post('/auth/mm/login', [
            'email' => 'manuel.ceppi@test.com',
            'password' => 'password123'
        ]);

        $response->assertJsonStructure(["error", "errorEx", "result" => ['token']]);
        $response->assertStatus(200);
    }
}
