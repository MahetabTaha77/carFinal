<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    User::factory(10)->create();
       Car::factory(10)->create();

        // User::create([
        //     'name'      => 'Admin',
        //     'username'  => 'admin',
        //     'email'     => 'admin@gmail.com',
        //     'password'  => Hash::make('123456789'),
        // ]);
    }
}