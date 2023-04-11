<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscriptionId' => Subscription::factory(),
            'dueDate' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'status' => "SUCCEEDED_PAYMENT",
            'trxId' => Str::uuid(),
            'trxTime' => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'amount' =>$this->faker->unique()->numberBetween($min = 10, $max = 50),
        ];
    }
}
