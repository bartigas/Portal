<?php

namespace App\Services;

use App\Contracts\ModulePermissionInterface;
use Illuminate\Support\Facades\File;

class ModuleService
{
    protected $permissionManager;

    public function __construct(PermissionManager $permissionManager)
    {
        $this->permissionManager = $permissionManager;
    }

    /**
     * Discover and register permissions for all modules
     * 
     * @return void
     */
    public function registerModulePermissions()
    {
        $modulesPath = base_path('Modules');
        
        // Scan Modules directory
        $modules = File::directories($modulesPath);

        foreach ($modules as $modulePath) {
            $moduleName = basename($modulePath);
            $permissionClass = "Modules\\{$moduleName}\\PermissionRegistrar";

            if (class_exists($permissionClass) && 
                is_subclass_of($permissionClass, ModulePermissionInterface::class)) {
                
                $registrar = app($permissionClass);
                $registrar->registerPermissions($this->permissionManager);
            }
        }
    }
}