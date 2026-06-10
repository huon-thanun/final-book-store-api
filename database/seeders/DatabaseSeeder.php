<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Administrator']);
        $staffRole = Role::create(['name' => 'staff', 'display_name' => 'Staff Member']);

        User::create([
            'name' => 'Thanun Admin',
            'email' => 'thanun.admin@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,  // លេខ 1
        ]);

        User::create([
            'name' => 'Nana Staff',
            'email' => 'nana.staff@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => $staffRole->id,  // លេខ 2
        ]);
    }
}
