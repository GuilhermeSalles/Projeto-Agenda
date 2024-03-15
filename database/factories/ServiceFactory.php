<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $durationOptions = [30, 60]; // Opções válidas para a duração
        $value = $this->faker->randomFloat(2, 10, 1000); // Valor aleatório entre R$ 10,00 e R$ 1000,00

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'duration' => $this->faker->randomElement($durationOptions),
            'value' => $value,
        ];
    }
}
