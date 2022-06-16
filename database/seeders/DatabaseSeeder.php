<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('123123123'),
        ]);

        Size::create([
            'size' => 'xl'
        ]);

        Category::create([
            'name' => 'Test Category',
        ]);

    }
}
