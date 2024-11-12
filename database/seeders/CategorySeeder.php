<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'ring',
                'type' => 'products',
                'image' => 'assets/images/ring.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'earring',
                'type' => 'products',
                'image' => 'assets/images/earring.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'anklet',
                'type' => 'products',
                'image' => 'assets/images/anklet.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'necklace',
                'type' => 'products',
                'image' => 'assets/images/necklace.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bracelet',
                'type' => 'products',
                'image' => 'assets/images/bracelet.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'semipart',
                'type' => 'parts',
                'image' => 'assets/images/semipart.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'chain',
                'type' => 'parts',
                'image' => 'assets/images/chain.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'stone',
                'type' => 'parts',
                'image' => 'assets/images/stone.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'clasp',
                'type' => 'parts',
                'image' => 'assets/images/clasp.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
