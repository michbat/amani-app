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

        $employeeRole = Role::create([
            'name' => 'employee',
        ]);

        User::create([
            'firstname' => 'User',
            'lastname' => 'User',
            'email' => 'user@user.com',
            'phone' => '0123456789',
            'password' => Hash::make('password'), //password
            'role_id' => $userRole->id,
            'status' => UserStatus::ACTIVE,
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
            'token' => '',
        ]);

        User::create([
            'firstname' => 'Employee',
            'lastname' => 'Employee',
            'email' => 'employee@employee.com',
            'phone' => '0214365879',
            'password' => Hash::make('password'), //password
            'role_id' => $employeeRole->id,
            'status' => UserStatus::ACTIVE,
            'token' => '',
        ]);
    }
}
