<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@ilershop.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Cliente normal
        User::create([
            'name' => 'Cliente Ejemplo',
            'email' => 'cliente@ilershop.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        // 10 usuarios adicionales
        User::factory(10)->create();
    }
}