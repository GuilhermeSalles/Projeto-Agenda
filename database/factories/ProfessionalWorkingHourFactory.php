<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\Professional;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProfessionalWorkingHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $professionalIds = Professional::pluck('id')->toArray();
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return [
            'professional_id' => $this->faker->randomElement($professionalIds),
            'day_of_week' => $this->faker->randomElement($daysOfWeek),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'break_start' => $this->faker->time('H:i:s'),
            'break_end' => $this->faker->time('H:i:s'),
        ];
    }
}
