<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Contracts\Http\Kernel;
//use Spatie\Permission\PermissionServiceProvider as SpatiePermissionServiceProvider;
use App\Services\PermissionManager;
use App\Services\ModuleService;

class PermissionServiceProvider extends ServiceProvider
{
    //public function boot(ModuleService $moduleService, Kernel $kernel)
    public function boot(ModuleService $moduleService)
    {
        // Register Spatie Permission Service Provider
        //$this->app->register(SpatiePermissionServiceProvider::class);
            
        // Register module permissions during boot
        $moduleService->registerModulePermissions();

        // Register middleware aliases
       /* $kernel->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
        $kernel->aliasMiddleware('permission', \Spatie\Permission\Middleware\PermissionMiddleware::class);
        $kernel->aliasMiddleware('role_or_permission', \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class);*/
    }

    public function register()
    {
        // Register Permission Manager
        $this->app->singleton(PermissionManager::class);
    }
}