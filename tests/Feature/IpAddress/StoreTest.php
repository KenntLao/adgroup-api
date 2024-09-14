<?php

namespace Tests\Feature\IpAddress;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed --class="UserSeeder"');
        
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_creates_an_ip_address()
    {
        $data = [
            'ip_address' => '192.168.1.1',
        ];

        $response = $this->postJson('/api/ip-address', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('ip_addresses', $data);
    }
}
