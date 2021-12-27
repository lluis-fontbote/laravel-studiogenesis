<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'amount' => $this->faker->randomFloat(2, 1, 10000),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(0)
        ];
    }
}
