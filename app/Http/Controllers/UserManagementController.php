<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $users = User::with('roles', 'permissions')
            ->when($request->input('search'), function($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->paginate(15);

        return view('users.index', compact('users'));
    }

    /**
     * Show user creation form
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a new user
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'roles' => 'array',
            'is_active' => 'boolean',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_active' => $request->boolean('is_active', true), // Default to active
        ]);

        if (isset($validatedData['roles'])) {
            $user->syncRoles($validatedData['roles']);
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Edit user details
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'roles' => 'array',
            'is_active' => 'boolean',
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validatedData = $request->validate($rules);

        // Update basic info
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->is_active = (bool) $request->input('is_active', true);

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        // Sync roles if provided
        if (isset($validatedData['roles'])) {
            $user->syncRoles($validatedData['roles']);
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting the last super admin
        if ($user->hasRole('super-admin') && User::role('super-admin')->count() <= 1) {
            return redirect()->route('users.index')
                ->with('error', 'Cannot delete the last super admin.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    /**
     * Manage user permissions
     */
    public function managePermissions(Request $request, User $user)
    {
        $permissions = Permission::all();
        
        if ($request->isMethod('POST')) {
            $validatedPermissions = $request->validate([
                'permissions' => 'array',
            ]);

            $user->syncPermissions($validatedPermissions['permissions'] ?? []);

            return redirect()->route('users.permissions', $user)
                ->with('success', 'Permissions updated successfully');
        }

        return view('users.permissions', compact('user', 'permissions'));
    }
}