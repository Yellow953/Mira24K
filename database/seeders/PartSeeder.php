<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        $parts = [
            [
                'category_id' => 6,
                'name' => 'Sample Part 1',
                'size' => 'Medium',
                'gr_pcs' => 1.5,
                'dollar_gr' => 25.0,
                'dollar_pcs' => 37.5,
                'group' => 'Group A',
                'mcode' => 'AB123',
                'reseller_id' => 1,
                'reseller_barcode' => '1234567890123',
                'image' => 'assets/images/ring.png',
                'faceted' => true,
                'color' => 'Red',
                'stone_pack' => 50.0,
                'role' => false,
                'thickness' => 0.5,
                'gr_dm' => 2.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 7,
                'name' => 'Sample Part 2',
                'size' => 'Large',
                'gr_pcs' => 2.0,
                'dollar_gr' => 30.0,
                'dollar_pcs' => 60.0,
                'group' => 'Group B',
                'mcode' => 'CD456',
                'reseller_id' => 2,
                'reseller_barcode' => '2345678901234',
                'image' => 'assets/images/ring.png',
                'faceted' => false,
                'color' => 'Blue',
                'stone_pack' => 75.0,
                'role' => true,
                'thickness' => 1.0,
                'gr_dm' => 3.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        foreach ($parts as $part) {
            Part::create($part);
        }
    }
}
