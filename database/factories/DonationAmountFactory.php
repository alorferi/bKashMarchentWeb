<?php

namespace Database\Factories;

use App\Models\DonationAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationAmountFactory extends Factory
{
    protected $model = DonationAmount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // $randomDigit = $this->faker->unique()->randomDigit;
        $randomDigit = $this->faker->unique()->numberBetween($min = 10, $max = 50);

        return [
            'name' => "{$randomDigit} BDT",
            'amount' =>  $randomDigit,
        ];
    }
}
