<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create some basic permissions
        $manageUsers = Permission::create(['name' => 'manage users']);
        $editUsers = Permission::create(['name' => 'edit users']);
        $viewUsers = Permission::create(['name' => 'view users']);

        // Assign all permissions to super admin
        $superAdmin->syncPermissions(Permission::all());
    }
}