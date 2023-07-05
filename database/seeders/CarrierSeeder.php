<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrierSeeder extends Seeder
{
    public function run()
    {
        DB::table('carriers')->insert([
            [
                'id' => 1,
                'name' => 'Chronopost',
                'description' => 'Lorem',
                'price' => '14.99',
                'created_at' => '2023-05-10 18:43:06',
                'updated_at' => '2023-05-10 18:43:06',
            ],
            [
                'id' => 2,
                'name' => 'Colissimo',
                'description' => 'Ipsum',
                'price' => '9.99',
                'created_at' => '2023-05-10 18:43:06',
                'updated_at' => '2023-05-10 18:43:06',
            ],
        ]);
    }
}
