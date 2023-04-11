<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscriptionRequestId' => "NonTragg".$this->faker->unique()->numberBetween($min = 10, $max = 50),
            'merchantId' => 9,
            'merchantShortCode' => null,
            'payer' => $this->faker->unique()->phoneNumber,
            'amount' => $this->faker->unique()->numberBetween($min = 10, $max = 50),
            'startDate' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'expiryDate' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'frequency' => "WEEKLY",
            'status' => "SUCCESS",
            'cancelledBy' => null,
            'cancelledTime' => null,

        ];
    }
}
