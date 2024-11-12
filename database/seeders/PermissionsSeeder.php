<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            'users.create',
            'users.read',
            'users.update',
            'users.delete',
            'users.export',

            // Products
            'products.create',
            'products.read',
            'products.update',
            'products.delete',
            'products.export',

            // Logs
            'logs.view',
            'logs.export',

            // Jewelry Models
            'jewelry_models.create',
            'jewelry_models.read',
            'jewelry_models.update',
            'jewelry_models.delete',
            'jewelry_models.export',

            // Parts
            'parts.create',
            'parts.read',
            'parts.update',
            'parts.delete',
            'parts.export',

            // Categories
            'categories.create',
            'categories.read',
            'categories.update',
            'categories.delete',
            'categories.export',

            // Resellers
            'resellers.create',
            'resellers.read',
            'resellers.update',
            'resellers.delete',
            'resellers.export',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        $adminRole->givePermissionTo(Permission::all());

        $staffPermissions = [
            'users.read',
            'products.read',
            'categories.read',
            'jewelry_models.read',
            'jewelry_models.update',
            'parts.read',
            'parts.create',
            'resellers.read',
        ];
        $staffRole->syncPermissions($staffPermissions);

        User::find(1)->assignRole($adminRole);
        User::find(2)->assignRole($staffRole);
    }
}
