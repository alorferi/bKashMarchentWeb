<?php

namespace Database\Seeders;

use App\Models\PaymentCycle;
use Illuminate\Database\Seeder;

class PaymentCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentCycles = [
            [ 'name'=> "DAILY",  'display_name'=>"Daily"
            ,'pre_notification_day'=>null
            , 'no_of_retrial'=>null
            ,'retrial_period'=>null
        ,'display_serial'=>null
        ],

            [ 'name'=> "WEEKLY",  'display_name'=>"7 Days"
            ,'pre_notification_day'=>1
            , 'no_of_retrial'=>1
            ,'retrial_period'=>"2 Days After Pay Date"
            ,'display_serial'=>null
        ],
            [ 'name'=> "FIFTEEN_DAYS",  'display_name'=>"15 Days"
            ,'pre_notification_day'=>2
            , 'no_of_retrial'=>2
            ,'retrial_period'=>"Every 3 Days After Pay Date"
            ,'display_serial'=>null],

            [ 'name'=> "THIRTY_DAYS",
            'display_name'=>"30 Days"
            ,'pre_notification_day'=>3
            , 'no_of_retrial'=>2
            ,'retrial_period'=>"Every 3 Days After Pay Date"
            ,'display_serial'=>null],


            [ 'name'=> "NINETY_DAYS",  'display_name'=>"90 Days"
            ,'pre_notification_day'=>3
            , 'no_of_retrial'=>2
            ,'retrial_period'=>"Every 3 Days After Pay Date"
            ,'display_serial'=>null],

            [ 'name'=> "ONE_EIGHTY_DAYS",  'display_name'=>"180 Days"
            ,'pre_notification_day'=>3
            , 'no_of_retrial'=>2
            ,'retrial_period'=>"Every 3 Days After Pay Date"
            ,'display_serial'=>null],

            [ 'name'=> "CALENDAR_MONTH",  'display_name'=>"Monthly"
            ,'pre_notification_day'=>3
            , 'no_of_retrial'=>2
            ,'retrial_period'=>"Every 3 Days After Pay Date"
            ,'display_serial'=>null],

            [ 'name'=> "CALENDAR_YEAR",  'display_name'=>"Yearly"
            ,'pre_notification_day'=>3
            , 'no_of_retrial'=>2
            ,'retrial_period'=>"Every 3 Days After Pay Date"
            ,'display_serial'=>null],
        ];

        foreach($paymentCycles as $paymentCycle) {
            PaymentCycle::factory()->create($paymentCycle);
        }
    }
}
