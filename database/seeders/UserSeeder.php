<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Marko Markovic',
            'email' => 'marko@gmail.com',
            'phone' => '0651234567',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        User::create([
            'name' => 'Dusan Milenkovic',
            'email' => 'dusan@gmail.com',
            'phone' => '0641234567',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
