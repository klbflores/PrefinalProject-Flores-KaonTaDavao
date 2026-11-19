<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'permit_no' => 'DVO-2026-' . fake()->unique()->numberBetween(1000, 99999),
            'expires_on' => fake()->dateTimeBetween('+1 month', '+1 year')->format('Y-m-d'),
        ];
    }
}