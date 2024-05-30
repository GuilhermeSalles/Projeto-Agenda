<?php

namespace Database\Factories;

use App\Models\Scheduling;
use App\Models\Professional;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchedulingFactory extends Factory
{
    protected $model = Scheduling::class;

    public function definition()
    {
        $professionalIds = Professional::pluck('id')->toArray();
        $serviceIds = Service::pluck('id')->toArray();

        // Define o intervalo de datas entre 29/05/2024 e 31/05/2024
        $startDate = Carbon::create(2024, 5, 28);
        $endDate = Carbon::create(2024, 6, 4);

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
