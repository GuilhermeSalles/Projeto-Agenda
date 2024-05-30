<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            ProfessionalSeeder::class,
            ProfessionalWorkingSeeder::class,
            UserSeeder::class,
            SchedulingSeeder::class,
        ]);
    }
}
