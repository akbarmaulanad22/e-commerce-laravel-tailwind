<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allPermissions = [
            Permission::create(['name' => 'create product']),
            Permission::create(['name' => 'read product']),
            Permission::create(['name' => 'update product']),
            Permission::create(['name' => 'delete product']),
            Permission::create(['name' => 'create category']),
            Permission::create(['name' => 'read category']),
            Permission::create(['name' => 'update category']),
            Permission::create(['name' => 'delete category']),

        ];
    }
}
