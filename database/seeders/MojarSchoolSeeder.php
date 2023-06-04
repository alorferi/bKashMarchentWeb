<?php

namespace Database\Seeders;

use App\Models\PaymentAmount;
use App\Models\PaymentFrequency;
use App\Models\PaymentSector;
use Illuminate\Database\Seeder;

class MojarSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $paymentAmounts = [
            [ 'currency'=> "BDT",  'amount'=>16,'is_active' => true],
            [ 'currency'=> "BDT",  'amount'=>21,'is_active' => true],
            [ 'currency'=> "BDT",  'amount'=>52,'is_active' => true],
            [ 'currency'=> "BDT",  'amount'=>71,'is_active' => true],
            [ 'currency'=> "BDT",  'amount'=>100,'is_active' => true],
            [ 'currency'=> "BDT",  'amount'=>1500,'is_active' => true],
            [ 'currency'=> "BDT",  'amount'=>5000,'is_active' => true],
            [ 'currency'=> "BDT",  'amount'=>10000,'is_active' => true],
        ];

        foreach($paymentAmounts as $paymentAmount) {
            PaymentAmount::factory()->create($paymentAmount);
        }


            PaymentFrequency::where('name','DAILY')->update([
                'merchant_display_name'=>"Daily",
                'display_serial'=>1,
                'is_active'=>true,
            ]);

            PaymentFrequency::where('name','WEEKLY')->update([
                'merchant_display_name'=>"Weekly",
                'display_serial'=>2,
                'is_active'=>true,
            ]);

            PaymentFrequency::where('name','CALENDAR_MONTH')->update([
                'merchant_display_name'=>"Monthly",
                'display_serial'=>3,
                'is_active'=>true,
            ]);


            PaymentFrequency::where('name','NINETY_DAYS')->update([
                'merchant_display_name'=>"Quarterly (3 Months)",
                'display_serial'=>4,
                'is_active'=>true,
            ]);


            PaymentFrequency::where('name','ONE_EIGHTY_DAYS')->update([
                'merchant_display_name'=>"Half Yearly (6 Months)",
                'display_serial'=>5,
                'is_active'=>true,
            ]);

            PaymentFrequency::where('name','CALENDAR_YEAR')->update([
                'merchant_display_name'=>"Yearly",
                'display_serial'=>6,
                'is_active'=>true,
            ]);



            $paymentSectors = [
                [ 'name'=> "General Donation", 'is_active' => true ],
                [ 'name'=> "Education Program", 'is_active' => true],
                [ 'name'=> "Sponsor a Child",'is_active' => true ],
                [ 'name'=> "Food Program", 'is_active' => true],
                [ 'name'=> "Health Care",'is_active' => true ],
                [ 'name'=> "Sadakah Fund",'is_active' => true ],
                [ 'name'=> "Zakat Fund", 'is_active' => true],
            ];


            foreach($paymentSectors as $paymentSector) {
                PaymentSector::factory()->create($paymentSector);
            }









    }
}
