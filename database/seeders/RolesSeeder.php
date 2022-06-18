<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
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
    }
}
