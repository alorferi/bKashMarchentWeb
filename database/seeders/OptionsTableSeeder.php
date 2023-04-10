<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([
            'option_name' => Option::siteurl,
            'option_value' => "www.site-domain.com",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::home,
            'option_value' => "www.site-domain.com",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::blogname,
            'option_value' => "Blog Name",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::blogdescription,
            'option_value' => "Blog Description",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::users_can_register,
            'option_value' => "0",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::admin_email,
            'option_value' => "",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::start_of_week,
            'option_value' => "0",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::use_balanceTags,
            'option_value' => "0",
            'autoload' => "yes"
        ]);
        Option::create([
            'option_name' => Option::use_smilies,
            'option_value' => "1",
            'autoload' => "yes"
        ]);
        Option::create([
            'option_name' => Option::require_name_email,
            'option_value' => "1",
            'autoload' => "yes"
        ]);
        Option::create([
            'option_name' => Option::comments_notify,
            'option_value' => "1",
            'autoload' => "yes"
        ]);
        Option::create([
            'option_name' => Option::posts_per_rss,
            'option_value' => "10",
            'autoload' => "yes"
        ]);
        Option::create([
            'option_name' => Option::rss_use_excerpt,
            'option_value' => "0",
            'autoload' => "yes"
        ]);
        Option::create([
            'option_name' => Option::mailserver_url,
            'option_value' => "mail.example.com",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::mailserver_login,
            'option_value' => "login@example.com",
            'autoload' => "yes"
        ]);

        Option::create([
            'option_name' => Option::mailserver_pass,
            'option_value' => "password",
            'autoload' => "yes"
        ]);
        Option::create([
            'option_name' => Option::mailserver_port,
            'option_value' => "110",
            'autoload' => "yes"
        ]);
    }
}
