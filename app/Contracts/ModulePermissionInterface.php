<?php

namespace App\Contracts;

use App\Services\PermissionManager;

interface ModulePermissionInterface
{
    /**
     * Register module-specific permissions and roles
     * 
     * @param PermissionManager $permissionManager
     * @return void
     */
    public function registerPermissions(PermissionManager $permissionManager): void;
}