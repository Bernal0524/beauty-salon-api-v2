<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Gerente General',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Estilista Uno',
            'email' => 'stylist1@example.com',
            'password' => Hash::make('password'),
            'role' => 'stylist',
        ]);

        User::create([
            'name' => 'Estilista Dos',
            'email' => 'stylist2@example.com',
            'password' => Hash::make('password'),
            'role' => 'stylist',
        ]);
    }
}

