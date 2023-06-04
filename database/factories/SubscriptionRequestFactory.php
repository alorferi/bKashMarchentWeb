<?php

namespace Database\Factories;

use App\Models\DonationSector;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'donationSectorId' =>  DonationSector::factory(),
        ];
    }
}
