<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investments>
 */
class InvestmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['CDB', 'LCI', 'Tesouro Direto']),
            'term_months' => $this->faker->numberBetween(1, 36),
            'minimum_value' => $this->faker->randomFloat(2, 100, 10000),
            'profitability' => $this->faker->randomFloat(2, 5, 15),
        ];
    }
}
