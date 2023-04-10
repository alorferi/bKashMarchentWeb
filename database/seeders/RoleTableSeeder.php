<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
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


        foreach (Permission::getPermissionList() as $permission_name) {

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


        $administrator->attachPermission(Permission::where('name',Permission::author_create)->first());
        $administrator->attachPermission(Permission::where('name',Permission::author_edit)->first());
        $administrator->attachPermission(Permission::where('name',Permission::author_index)->first());


        Role::create([
            'name' => Role::author,
            'display_name' => 'Author',
        ]);


        Role::create([
            'name' => Role::seo_editor,
            'display_name' => 'SEO Editor',
        ]);

        Role::create([
            'name' => Role::seo_manager,
            'display_name' => 'SEO Manager',
        ]);

        Role::create([
            'name' => Role::subscriber,
            'display_name' => 'Subscriber',
        ]);

        Role::create([
            'name' => Role::contributor,
            'display_name' => 'Contributor',
        ]);

        Role::create([
            'name' => Role::editor,
            'display_name' => 'Editor',
        ]);
    }
}
