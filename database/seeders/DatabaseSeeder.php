<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OptionsTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        $adminRole = Role::where('name', '=', 'ga')->first();
        $saRole = Role::where('name', '=', 'sa')->first();

      $babul =  User::factory()->create(
            [
                'name' => "Babul Mirdha",
                'email' => "babumirdha@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('bm@1123'), // password
                'remember_token' => Str::random(10),
            ]
        );

        $babul->attachRole($saRole);

        $iqbal =  User::factory()->create(
            [
                'name' => "Iqbal Hossain",
                'email' => "iqbalh8622@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('iq@1123'), // password
                'remember_token' => Str::random(10),
            ]
        );

        $iqbal->attachRole($adminRole);

        User::factory(10)->create();

        Post::factory(20)->create();

        Comment::factory(20)->create();




    }
}
