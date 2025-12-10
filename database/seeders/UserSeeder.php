<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
       User::updateOrCreate(
    ['email' => 'admin@gmail.com'],
    [
        'name' => 'Admin',
        'password' => Hash::make('123456'),
        'role' => 'admin'
    ]
);

        User::updateOrCreate(
    ['email' => 'user@gmail.com'],
    [
        'name' => 'User Biasa',
        'password' => Hash::make('123456'),
        'role' => 'user'
    ]
);
    }
}
