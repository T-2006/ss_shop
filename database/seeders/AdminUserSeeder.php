<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('nombre', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@ss-shop.com'],
            [
                'role_id' => $adminRole->id,
                'name' => 'Administrador',
                'password' => Hash::make('password123'), // cámbiala luego
            ]
        );
    }
}
