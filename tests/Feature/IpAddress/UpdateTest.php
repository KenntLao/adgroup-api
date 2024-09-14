<?php

namespace Tests\Feature\IpAddress;

use App\Models\IpAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed --class="UserSeeder"');
        
        $this->actingAs(User::factory()->create(), 'sanctum');
    }
    
    public function test_updates_an_ip_address()
    {
        $ipAddress = IpAddress::factory()->create();

        $data = [
            'label' => 'Updated Label',
        ];

        $response = $this->patchJson("/api/ip-address/{$ipAddress->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);

        $this->assertDatabaseHas('ip_addresses', [
            'id' => $ipAddress->id,
            'label' => 'Updated Label',
        ]);
    }
}
