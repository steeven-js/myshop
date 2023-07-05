<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->get();

        foreach ($categories as $category) {
            foreach ($users as $user) {
                for ($i = 1; $i <= 5; $i++) {
                    $price = rand(15000, 90000) / 100; // Prix aléatoire entre 150€ et 900€

                    DB::table('products')->insert([
                        'category_id' => $category->id,
                        'user_id' => $user->id,
                        'name' => 'Product '.$i,
                        'description' => 'Description of Product '.$i,
                        'prix' => $price,
                        'image' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
