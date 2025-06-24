<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Create Admin User ---
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Hash the password
                'role_id' => $adminRole->id,
                'email_verified_at' => now(), // Mark email as verified
            ]);
        }

        // --- Create Event Creator User ('Pembuat Event') ---
        $eventCreatorRole = Role::where('name', 'Pembuat Event')->first();
        if ($eventCreatorRole) {
            User::create([
                'name' => 'Event Creator',
                'email' => 'creator@example.com',
                'password' => Hash::make('password'), // Hash the password
                'role_id' => $eventCreatorRole->id,
                'email_verified_at' => now(), // Mark email as verified
            ]);
        }

        // --- Create Student User ('Mahasiswa') ---
        $studentRole = Role::where('name', 'Mahasiswa')->first();
        if ($studentRole) {
            User::create([
                'name' => 'Student User',
                'email' => 'student@example.com',
                'password' => Hash::make('password'), // Hash the password
                'role_id' => $studentRole->id,
                'email_verified_at' => now(), // Mark email as verified
            ]);
        }
    }
}
