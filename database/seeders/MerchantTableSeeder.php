<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class MerchantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $saRole =   Role::create([
            'name' => Role::sa,
            'display_name' => 'Super Admin',
        ]);


        foreach (Permission::getMerchantPermissionList() as $permission_name) {

            $permission = Permission::create([
            'name' => $permission_name,
            'display_name' => $permission_name,
        ]);

            $saRole->attachPermission($permission);
        }

        $administrator =   Role::create([
            'name' => Role::administrator,
            'display_name' => 'Administrator',
        ]);

    }
}
