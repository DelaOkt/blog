<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dummy User',
            'email' => 'dummyuser@example.com',
            'password' => Hash::make('password123'), // password untuk login
        ]);
    }
}
