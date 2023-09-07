<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create([
            'name' => 'user',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $personnelRole = Role::create([
            'name' => 'personnel',
        ]);

        User::create([
            'firstname' => 'User',
            'lastname' => 'User',
            'email' => 'user@user.com',
            'phone' => '0123456789',
            'password' => Hash::make('password'), //password
            'role_id' => $userRole->id,
            'status' => UserStatus::ACTIVE,
            'canReserveTable' => true,
            'token' => '',
        ]);

        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '0987654321',
            'password' => Hash::make('password'), //password
            'role_id' => $adminRole->id,
            'status' => UserStatus::ACTIVE,
            'canReserveTable' => true,
            'token' => '',
        ]);

        User::create([
            'firstname' => 'Personnel',
            'lastname' => 'Personnel',
            'email' => 'personnel@personnel.com',
            'phone' => '0214365879',
            'password' => Hash::make('password'), //password
            'role_id' => $personnelRole->id,
            'status' => UserStatus::ACTIVE,
            'canReserveTable' => true,
            'token' => '',
        ]);
    }
}
