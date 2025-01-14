<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists to prevent duplicates
        $existingAdmin = User::where('email', 'admin@example.com')->first();
        
        if (!$existingAdmin) {
            $admin = User::create([
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('Password123!'),
                'email_verified_at' => now(), // Automatically verify the email
            ]);

            // Assign super-admin role
            $admin->assignRole('super-admin');
        } else {
            // Ensure existing admin has the super-admin role
            $existingAdmin->assignRole('super-admin');
        }
    }
}
