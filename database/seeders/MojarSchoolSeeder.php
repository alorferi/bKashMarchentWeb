<?php

namespace Database\Seeders;

use App\Models\PaymentAmount;
use App\Models\PaymentCycle;
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
            [ 'name'=> "16 BDT",  'amount'=>16],
            [ 'name'=> "21 BDT",  'amount'=>21],
            [ 'name'=> "52 BDT",  'amount'=>52],
            [ 'name'=> "71 BDT",  'amount'=>71],
            [ 'name'=> "100 BDT",  'amount'=>100],
            [ 'name'=> "1500 BDT",  'amount'=>1500],
            [ 'name'=> "5000 BDT",  'amount'=>5000],
            [ 'name'=> "10000 BDT",  'amount'=>10000],
        ];

        foreach($paymentAmounts as $paymentAmount) {
            PaymentAmount::factory()->create($paymentAmount);
        }


            PaymentCycle::where('name','DAILY')->update([
                'merchant_display_name'=>"Daily",
                'display_serial'=>1,
                'is_active'=>true,
            ]);

            PaymentCycle::where('name','WEEKLY')->update([
                'merchant_display_name'=>"Weekly",
                'display_serial'=>2,
                'is_active'=>true,
            ]);

            PaymentCycle::where('name','CALENDAR_MONTH')->update([
                'merchant_display_name'=>"Monthly",
                'display_serial'=>3,
                'is_active'=>true,
            ]);


            PaymentCycle::where('name','NINETY_DAYS')->update([
                'merchant_display_name'=>"Quarterly (3 Months)",
                'display_serial'=>4,
                'is_active'=>true,
            ]);


            PaymentCycle::where('name','ONE_EIGHTY_DAYS')->update([
                'merchant_display_name'=>"Half Yearly (6 Months)",
                'display_serial'=>5,
                'is_active'=>true,
            ]);

            PaymentCycle::where('name','CALENDAR_YEAR')->update([
                'merchant_display_name'=>"Yearly",
                'display_serial'=>6,
                'is_active'=>true,
            ]);



            $paymentSectors = [
                [ 'name'=> "General Donation", ],
                [ 'name'=> "Education Program", ],
                [ 'name'=> "Sponsor a Child", ],
                [ 'name'=> "Food Program", ],
                [ 'name'=> "Health Care", ],
                [ 'name'=> "Sadakah Fund", ],
                [ 'name'=> "Zakat Fund", ],
            ];


            foreach($paymentSectors as $paymentSector) {
                PaymentSector::factory()->create($paymentSector);
            }









    }
}
