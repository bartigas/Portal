<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PermissionManager;
use App\Services\ModuleService;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot(ModuleService $moduleService)
    {
        // Register module permissions during boot
        $moduleService->registerModulePermissions();
    }

    public function register()
    {
        $this->app->singleton(PermissionManager::class);
    }
}