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
     *
     * @return void
     */
    public function run()
    {
        $role = [
            Role::create(['name' => 'Super user']),
            Role::create(['name' => 'Seller']),
            Role::create(['name' => 'Buyer']),
        ];

        $allPermissions = [
            Permission::create(['name' => 'create product']),
            Permission::create(['name' => 'read product']),
            Permission::create(['name' => 'update product']),
            Permission::create(['name' => 'delete product']),
            Permission::create(['name' => 'buy product']),
            Permission::create(['name' => 'create category']),
            Permission::create(['name' => 'read category']),
            Permission::create(['name' => 'update category']),
            Permission::create(['name' => 'delete category']),
        ];

        $role[0]->givePermissionTo($allPermissions);
        $role[1]->givePermissionTo($allPermissions[0]);
        $role[1]->givePermissionTo($allPermissions[1]);
        $role[1]->givePermissionTo($allPermissions[2]);
        $role[1]->givePermissionTo($allPermissions[3]);
        $role[2]->givePermissionTo($allPermissions[4]);
    }
}
