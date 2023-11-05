<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $foodCategories = array(
            'Appetizers',
            'Main Dishes',
            'Desserts',
            'Beverages',
            'Salads',
            'Pizzas',
            'Burgers',
            'Seafood',
            'Pasta',
            'Sushi',
            'Vegetarian',
            'Sandwiches',
            'Soups',
            'Chicken',
            'Steaks',
            'Mexican',
            'Italian',
            'Chinese',
            'Indian',
            'Thai',
            'Japanese',
            'Mediterranean',
            'Fast Food',
            'BBQ',
            'Vegan',
            'Gluten-Free',
            'Greek',
            'Korean',
            'French',
            'Turkish',
            'Vietnamese',
            'Cajun',
            'African',
            'Spanish',
            'Brazilian',
            'German',
            'Soul Food',
            'Peruvian',
            'Irish',
            'Middle Eastern',
            'Russian',
            'Polish',
            'Swedish',
            'Caribbean');
            return [
                'name' => array_rand($foodCategories),
            ];
    }
}
