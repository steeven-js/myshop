<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Drône', 'icon' => null],
            ['name' => 'Iphone', 'icon' => null],
            ['name' => 'Montre connecté', 'icon' => null],
            ['name' => 'Ordinateur portable', 'icon' => null],
            ['name' => 'Smartphone', 'icon' => null],
        ];

        DB::table('categories')->insert($categories);
    }
}
