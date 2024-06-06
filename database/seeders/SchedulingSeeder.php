<?php

namespace Database\Seeders;

use App\Models\Scheduling;
use Illuminate\Database\Seeder;

class SchedulingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use a Factory para criar 35 registros fictícios de agendamentos
        Scheduling::factory(35)->create();
    }
}
