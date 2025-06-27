<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $adminPermissions = [];
        array_push($adminPermissions, Permission::create(['name' => 'modify article']));
        array_push($adminPermissions, Permission::create(['name' => 'modify exam']));
        array_push($adminPermissions, Permission::create(['name' => 'modify activity']));
        array_push($adminPermissions, Permission::create(['name' => 'modify user']));

        foreach ($adminPermissions as $permission) {
            $adminRole->givePermissionTo($permission);
        }
    }
}
