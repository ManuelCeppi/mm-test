<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthcheckTest extends TestCase
{
    public function test_healthcheck(): void
    {
        $response = $this->get('/api/mm/healthcheck');

        $response->assertStatus(200);
    }
}
