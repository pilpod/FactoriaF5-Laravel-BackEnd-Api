<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'img' => $this->faker->imageUrl(640, 480),
            'ingredients' => $this->faker->sentence(6),
            'price' => $this->faker->numberBetween(5, 50),
        ];
    }
}
