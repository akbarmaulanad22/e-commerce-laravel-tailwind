<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // 

        // $this->call(PermissonsSeeder::class);
        // $this->call(RolesSeeder::class);

        // DB::beginTransaction();
        // try {
            $this->call(RolePermissionSeeder::class);

            Product::factory(100)->create();
            
            $user1 = User::create([
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'password' => Hash::make('123123123'),
                ])->assignRole(Role::find(1));

            $user1->getPermissionsViaRoles();
                
            $user2 = User::create([
                    'name' => 'Test1 User',
                    'email' => 'test1@example.com',
                    'password' => Hash::make('123123123'),
            ])->assignRole(Role::find(2));

            $user2->getPermissionsViaRoles();
        
                Size::create([
                    'size' => 'xl'
                ]);
        
                Category::create([
                    'name' => 'Test Category',
                    'slug' => 'test-category',
                ]);

        //         DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        // }

    }
}
