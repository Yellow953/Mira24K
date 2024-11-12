<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'ring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'necklace',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'bracelet',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
