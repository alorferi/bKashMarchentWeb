<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OtcType;

class OtcTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        OtcType::create(
            [
                'name' => "SHOW_MY_SUBSCRIPTIONS",
                'sms_template' => "Use # for two factor authentication to registration on Alor Feri.",
                'email_subject_template' => "Use OTC for two factor authentication on Alor Feri.",
                'email_body_template' => "<p>Use <b>#</b> for two factor authentication on Alor Feri.</p>"
            ]

        );

        OtcType::create(
            [
                'name' => "REGISTER_USER",
                'sms_template' => "Use # for two factor authentication to registration on Alor Feri.",
                'email_subject_template' => "Use OTC for two factor authentication on Alor Feri.",
                'email_body_template' => "<p>Use <b>#</b> for two factor authentication on Alor Feri.</p>"
            ]

        );

        OtcType::create(
            [
                'name' => "RESET_PASSWORD",
                'sms_template' => "Use # for two factor authentication to reset password on Alor Feri.",
                'email_subject_template' => "Use OTC for two factor authentication on Alor Feri.", 'email_body_template' => "<p>Use <b>#</b> for two factor authentication on Alor Feri.</p>"
            ]

        );
    }
}
