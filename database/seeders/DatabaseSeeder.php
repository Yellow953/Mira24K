<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PermissionsSeeder::class,
            CategorySeeder::class,
            ResellerSeeder::class,
            PartSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
