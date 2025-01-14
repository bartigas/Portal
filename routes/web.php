<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// User Management Routes
Route::middleware(['auth', RoleMiddleware::class.':super-admin'])->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])
        ->name('users.index');
    
    Route::get('/users/create', [UserManagementController::class, 'create'])
        ->name('users.create');
    
    Route::post('/users', [UserManagementController::class, 'store'])
        ->name('users.store');
    
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
        ->name('users.edit');
    
    Route::put('/users/{user}', [UserManagementController::class, 'update'])
        ->name('users.update');
    
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])
        ->name('users.destroy');
    
    // Permissions management route
    Route::match(['get', 'post'], '/users/{user}/permissions', [UserManagementController::class, 'managePermissions'])
        ->name('users.permissions');
});
