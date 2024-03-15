<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ProfessionalWorkingHour;
use App\Models\Service;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scheduling>
 */
class SchedulingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $professionalIds = ProfessionalWorkingHour::pluck('id')->toArray();
        $serviceIds = Service::pluck('id')->toArray();

        // Definindo um intervalo de datas dentro dos próximos 12 meses
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addMonths(12);

        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'pro' => $this->faker->randomElement($professionalIds),
            'service' => $this->faker->randomElement($serviceIds),
            'date' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'time' => $this->faker->time(),
            'fulfilled' => $this->faker->boolean(),
        ];
    }
}
