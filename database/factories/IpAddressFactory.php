<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\IpAddress;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IpAddress>
 */
class IpAddressFactory extends Factory
{
    protected $model = IpAddress::class;

    public function definition()
    {
        return [
            'ip_address' => $this->faker->ipv4,
            'label' => $this->faker->word,
        ];
    }
}
