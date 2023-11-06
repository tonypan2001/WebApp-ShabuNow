<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $status = array('available','outofstock');
        $foodNames = array(
            'Spaghetti Bolognese',
            'Chicken Alfredo',
            'Margherita Pizza',
            'Cheeseburger',
            'Sushi Roll',
            'Caesar Salad',
            'Chicken Tenders',
            'Grilled Salmon',
            'Beef Stir-Fry',
            'Mushroom Risotto',
            'Chocolate Cake',
            'Pasta Carbonara',
            'Fish and Chips',
            'Shrimp Scampi',
            'BBQ Ribs',
            'Vegetable Curry',
            'Taco Supreme',
            'Chicken Shawarma',
            'Pho Noodle Soup',
            'Egg Fried Rice',
            'Greek Salad',
            'Lobster Bisque',
            'Vegetarian Burger',
            'Clam Chowder',
            'Sausage and Peppers',
            'Creme Brulee',
            'Chicken Parmesan',
            'Pad Thai',
            'Fajitas',
            'Onion Rings',
            'Tandoori Chicken',
            'Gyro Sandwich',
            'Hawaiian Pizza',
            'Avocado Toast',
            'Chow Mein',
            'Cobb Salad',
            'Pork Chops',
            'Baked Ziti',
            'Tiramisu',
            'Lemonade',
            'Blueberry Pancakes',
            'Steak Sandwich',
            'Tomato Soup',
            'Apple Pie',
            'Key Lime Pie');
        return [
            'name' => $foodNames[array_rand($foodNames)],
            'category_id' => Category::find(rand(1, 5)),
            'description' => fake()->realTextBetween(120,200,2),
            'status' => $status[array_rand($status)],
            'price' => fake()->numberBetween(20,200),
        ];
    }
}
