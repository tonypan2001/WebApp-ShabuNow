<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(OrderSeeder::class);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'Admin@example.com',
            'role' => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Staff User',
            'email' => 'Staff@example.com',
            'role' => 'staff',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Chef User',
            'email' => 'Chef@example.com',
            'role' => 'chef',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Customer User',
            'email' => 'Customer@example.com',
            'role' => 'customer',
        ]);
    }
}
