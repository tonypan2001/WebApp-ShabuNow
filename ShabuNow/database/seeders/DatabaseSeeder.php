<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
//        $this->call(OrderSeeder::class);
        $this->call(HistorySeeder::class);
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);
        \App\Models\User::factory()->create([
            'username' => 'Test admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'username' => 'Staff',
            'email' => 'Staff@example.com',
            'role' => 'staff',
        ]);
        \App\Models\User::factory()->create([
            'username' => 'Chef',
            'email' => 'Chef@example.com',
            'role' => 'chef',
        ]);
        \App\Models\User::factory()->create([
            'username' => 'Customer',
            'email' => 'Customer@example.com',
            'role' => 'customer',
        ]);

        foreach (User::all() as $user) {
            if($user->role == 'customer') {
                $number = rand(1, 20);
                $table = Table::where('id', $number)->first();
                if($table->status == 'available')
                    $user->tableNumber = $number;
                    $table->user_id = $user->id;
                    $table->status = 'used';

                    Order::factory()->create([
                        'table_id' => $table->id,
                    ]);

                $table->save();
                $user->save();
            }
        }
    }
}
