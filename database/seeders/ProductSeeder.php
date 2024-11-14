<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [

                'category_id' => 1,
                'title' => 'Elegant Necklace',
                'mcode' => 'NEC123',
                'karat' => 18,
                'weight' => 10.5,
                'price' => 1200.00,
                'compare_price' => 1400.00,
                'description' => 'A beautiful 18-karat gold necklace with intricate designs.',
                'image' => 'assets/images/ring.png',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'category_id' => 2,
                'title' => 'Diamond Ring',
                'mcode' => 'RNG456',
                'karat' => 24,
                'weight' => 5.2,
                'price' => 2500.00,
                'compare_price' => 2800.00,
                'description' => 'A 24-karat diamond ring with a flawless cut.',
                'image' => 'assets/images/ring.png',

                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
