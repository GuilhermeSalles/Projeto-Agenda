<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       $this->call([
        ProfessionalSeeder::class,
        ProfessionalWorkingSeeder::class,
        ServiceSeeder::class,
        SchedulingSeeder::class,
       ]);
    }
}
