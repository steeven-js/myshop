<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = [
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('85245600'),
        ];

        DB::table('users')->insert($user);
    }
}
