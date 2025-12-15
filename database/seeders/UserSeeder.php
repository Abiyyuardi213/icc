<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $participantRole = Role::where('name', 'Participant')->first();

        // Create Admin User
        if ($adminRole) {
            User::firstOrCreate(
                ['email' => 'admin@admin.com'],
                [
                    'name' => 'Administrator',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'role_id' => $adminRole->id,
                    'remember_token' => Str::random(10),
                ]
            );
        }

        // Create Participant User
        if ($participantRole) {
            User::firstOrCreate(
                ['email' => 'user@user.com'],
                [
                    'name' => 'Demo Participant',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'role_id' => $participantRole->id,
                    'remember_token' => Str::random(10),
                ]
            );
        }
    }
}
