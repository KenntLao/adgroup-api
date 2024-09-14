<?php

namespace Tests\Feature\IpAddress;

use App\Models\IpAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed --class="UserSeeder"');
        
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_returns_a_list_of_ip_addresses()
    {
        $ipAddresses = IpAddress::factory()->count(3)->create();

        $response = $this->getJson('/api/ip-address');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'ip_address',
                'label'
            ]
        ]);

        $responseData = $response->json();
        $this->assertCount(3, $responseData);
    }
}
