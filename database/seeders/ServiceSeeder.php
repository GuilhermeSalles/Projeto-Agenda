<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criação de serviços específicos
        $services = [
            ['name' => 'Corte', 'duration' => 30, 'value' => 30.00],
            ['name' => 'Barba', 'duration' => 30, 'value' => 25.00],
            ['name' => 'Corte + Barba', 'duration' => 60, 'value' => 50.00],
            ['name' => 'Corte + Sobrancelha', 'duration' => 30, 'value' => 40.00],
            ['name' => 'Corte + Relaxamento', 'duration' => 60, 'value' => 70.00],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
