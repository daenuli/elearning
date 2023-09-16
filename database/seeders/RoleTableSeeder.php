<?php

namespace Database\Seeders;

use function PHPSTORM_META\map;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Teacher', 'guard_name' => 'web'],
            ['name' => 'Student', 'guard_name' => 'web'],
        ];

        $permissions = [
            ['name' => 'view backend', 'guard_name' => 'web'],
            ['name' => 'view frontend', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) 
        {
            Role::create($role);
        }

        foreach ($permissions as $permission) 
        {
            Permission::create($permission);
        }

        $admin_role = Role::find(1);
        $admin_role->givePermissionTo('view backend');
    }
}
