<?php

namespace Database\Factories;

use App\Models\PaymentAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentAmountFactory extends Factory
{
    protected $model = PaymentAmount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // $randomDigit = $this->faker->unique()->randomDigit;
        // $randomDigit = $this->faker->unique()->numberBetween($min = 10, $max = 50);

        return [
            // 'amount' =>  $randomDigit,
        ];
    }
}
