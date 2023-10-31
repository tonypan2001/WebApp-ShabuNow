<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = array('pending','ordered','ready','served');
        return [
            'name' => fake()->name(),
            'menu_id' => Menu::find(rand(1, 20)),
            'quantity' => fake()->numberBetween(1,10),
            'detail' => fake()->realTextBetween(120,200,2),
            'status' => $status[array_rand($status)],
            'table_id' => fake()->numberBetween(1,20),
        ];
    }
}
