<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionManager
{
    /**
     * Register permissions for a specific module
     * 
     * @param string $moduleName
     * @param array $permissions
     * @return void
     */
    public function registerModulePermissions(string $moduleName, array $permissions)
    {
        // Ensure module-specific guard exists
        $guardName = $this->getModuleGuard($moduleName);

        // Create permissions
        foreach ($permissions as $permissionKey => $description) {
            Permission::firstOrCreate([
                'name' => "{$moduleName}.{$permissionKey}",
                'guard_name' => $guardName,
                'description' => $description
            ]);
        }
    }

    /**
     * Register roles for a specific module
     * 
     * @param string $moduleName
     * @param array $roles
     * @return void
     */
    public function registerModuleRoles(string $moduleName, array $roles)
    {
        $guardName = $this->getModuleGuard($moduleName);

        foreach ($roles as $roleName => $permissions) {
            // Create role
            $role = Role::firstOrCreate([
                'name' => "{$moduleName}.{$roleName}",
                'guard_name' => $guardName
            ]);

            // Assign permissions to role
            $permissionObjects = collect($permissions)->map(function ($permissionKey) use ($moduleName, $guardName) {
                return Permission::firstOrCreate([
                    'name' => "{$moduleName}.{$permissionKey}",
                    'guard_name' => $guardName
                ]);
            });

            $role->syncPermissions($permissionObjects);
        }
    }

    /**
     * Generate a unique guard name for a module
     * 
     * @param string $moduleName
     * @return string
     */
    protected function getModuleGuard(string $moduleName): string
    {
        return "module_{$moduleName}";
    }

    /**
     * Get all registered module permissions
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRegisteredModulePermissions()
    {
        return Permission::where('name', 'LIKE', '%.%')->get();
    }
}