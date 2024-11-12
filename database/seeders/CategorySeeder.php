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
                'image' => 'assets/images/ring.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'earring',
                'image' => 'assets/images/earring.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ankelet',
                'image' => 'assets/images/ankeletring.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'necklace',
                'image' => 'assets/images/necklace.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bracelet',
                'image' => 'assets/images/bracelet.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
