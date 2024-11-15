<?php

namespace Database\Seeders;

use App\Models\General;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    public function run(): void
    {
        $generals = [
            [
                'title' => 'gold_price',
                'value' => '70.08',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'min_gram_profit',
                'value' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'max_gram_profit',
                'value' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($generals as $general) {
            $general = General::create($general);
        }
    }
}
