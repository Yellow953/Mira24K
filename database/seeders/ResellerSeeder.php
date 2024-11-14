<?php

namespace Database\Seeders;

use App\Models\Reseller;
use Illuminate\Database\Seeder;

class ResellerSeeder extends Seeder
{
    public function run(): void
    {
        $resellers = [
            [
                'name' => 'Reseller One',
                'address' => '123 Main St, Cityville',
                'gsm' => '1234567890',
                'phone' => '0987654321',
                'email' => 'contact@resellerone.com',
                'contact_person' => 'John Doe',
                'notes' => 'Top-performing reseller in 2023',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reseller Two',
                'address' => '456 Elm St, Townsville',
                'gsm' => '2345678901',
                'phone' => '1098765432',
                'email' => 'contact@resellertwo.com',
                'contact_person' => 'Jane Smith',
                'notes' => 'Specializes in luxury items',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        foreach ($resellers as $reseller) {
            Reseller::create($reseller);
        }
    }
}
