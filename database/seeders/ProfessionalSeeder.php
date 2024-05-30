<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professional;
use App\Models\Service;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtém todos os IDs dos serviços
        $serviceIds = Service::pluck('id')->toArray();

        // Cria um novo profissional com todas as especializações
        Professional::create([
            'name' => 'Lucas Garcia',
            'specializations' => json_encode($serviceIds), // Codifica os IDs dos serviços como JSON
        ]);
    }
}
