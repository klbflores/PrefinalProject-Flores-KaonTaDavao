<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Adobong Manok', 'Sinigang', 'Pork Sisig', 'Bicol Express', 'Lechon Kawali', 'Halo-Halo', 'Bulalo', 'Pinakbet']),
            'price' => fake()->randomFloat(2, 35, 250),
            'is_bestseller' => fake()->boolean(30),
        ];
    }
}