<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $permissions = [

            // Company
            'manage companies',
            'view companies',

            // Warehouse
            'create warehouse',
            'edit warehouse',
            'delete warehouse',
            'view warehouse',

            // Users
            'create user',
            'edit user',
            'delete user',
            'view user',

            // Stock
            'manage stock',
            'transfer stock',
            'adjust stock',
            'view stock',

            // Sales & Purchase
            'create purchase',
            'view purchase',
            'create sales',
            'view sales',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $companyAdmin = Role::firstOrCreate(['name' => 'Company Admin']);
        $warehouseManager = Role::firstOrCreate(['name' => 'Warehouse Manager']);
        $accountant = Role::firstOrCreate(['name' => 'Accountant']);
        $storeKeeper = Role::firstOrCreate(['name' => 'Store Keeper']);
        $salesExecutive = Role::firstOrCreate(['name' => 'Sales Executive']);

        // Super Admin gets everything
        $superAdmin->givePermissionTo(Permission::all());

        // Company Admin
        $companyAdmin->givePermissionTo([
            'view companies',
            'create warehouse',
            'edit warehouse',
            'view warehouse',
            'create user',
            'edit user',
            'view user',
            'view stock',
        ]);

        // Warehouse Manager
        $warehouseManager->givePermissionTo([
            'create warehouse',
            'edit warehouse',
            'view warehouse',
            'manage stock',
            'transfer stock',
            'view stock',
        ]);

        // Store Keeper
        $storeKeeper->givePermissionTo([
            'manage stock',
            'view stock',
        ]);

        // Accountant
        $accountant->givePermissionTo([
            'create purchase',
            'view purchase',
            'view sales',
        ]);

        // Sales Executive
        $salesExecutive->givePermissionTo([
            'create sales',
            'view sales',
        ]);
    }
}
