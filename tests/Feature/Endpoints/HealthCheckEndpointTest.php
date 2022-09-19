<?php

namespace Tests\Feature\Endpoints;

use Tests\TestCase;

class HealthCheckEndpointTest extends TestCase
{
    /** @test */
    public function it_will_check_the_server_status(): void
    {
        $this->withoutMiddleware();

        $response = $this->get('/api');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'OK!',
            'status_code' => 200,
        ]);
    }
}
