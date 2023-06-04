<?php

namespace Database\Factories;

use App\Models\SubscriptionRequest;
use Carbon\Carbon;
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
            'subscriptionRequestId' => SubscriptionRequest::factory(),
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
            'createdAt' => \Carbon\Carbon::now(),
            'modifiedAt' => \Carbon\Carbon::now(),
            'requesterId' => 2,
            'serviceId' => 1001,
            "payerType" =>  "CUSTOMER",
            "paymentType" =>  "FIXED",
            "subscriptionType" =>  "BASIC",
            "maxCapRequired" => false,
            "currency" => "BDT",
            "nextPaymentDate" => \Carbon\Carbon::now(),
            "subscriptionReference" => "",
            "enabled" => true,
            "expired" => false,
            "rrule" => "",
            "active" => true,

        ];
    }
}
