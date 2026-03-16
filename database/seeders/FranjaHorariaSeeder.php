<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FranjaHoraria;

class FranjaHorariaSeeder extends Seeder
{
    public function run(): void
    {
        $franjas = [
            ['nombre' => '1ª Hora', 'hora_inicio' => '08:00', 'hora_fin' => '09:00'],
            ['nombre' => '2ª Hora', 'hora_inicio' => '09:00', 'hora_fin' => '10:00'],
            ['nombre' => '3ª Hora', 'hora_inicio' => '10:00', 'hora_fin' => '11:00'],
            ['nombre' => 'Recreo',  'hora_inicio' => '11:00', 'hora_fin' => '11:30'],
            ['nombre' => '4ª Hora', 'hora_inicio' => '11:30', 'hora_fin' => '12:30'],
            ['nombre' => '5ª Hora', 'hora_inicio' => '12:30', 'hora_fin' => '13:30'],
            ['nombre' => '6ª Hora', 'hora_inicio' => '13:30', 'hora_fin' => '14:30'],
        ];

        foreach ($franjas as $franja) {
            FranjaHoraria::create($franja);
        }
    }
}

?>
