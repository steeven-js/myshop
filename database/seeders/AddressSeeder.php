<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'name' => 'villa 1',
                'company' => null,
                'address' => 'rue de monaco',
                'postal' => '20',
                'city' => 'Monté carlo',
                'country' => 'Monaco',
                'phone' => '258639457685',
                'created_at' => '2023-05-10 19:03:35',
                'updated_at' => '2023-06-11 21:05:28',
                'full_address' => 'rue de monaco<br>20 Monté carlo<br>Monaco',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'name' => 'villa 2',
                'company' => null,
                'address' => 'rue de miami',
                'postal' => '30',
                'city' => 'Miami',
                'country' => 'USA',
                'phone' => '245869574185',
                'created_at' => '2023-05-10 19:03:35',
                'updated_at' => '2023-06-11 21:05:36',
                'full_address' => 'rue de miami<br>30 Miami<br>USA',
            ],
        ]);
    }
}
