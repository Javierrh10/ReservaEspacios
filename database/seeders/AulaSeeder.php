<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aula;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aulas = [
            ['nombre' => 'Aula 101', 'capacidad' => 30],
            ['nombre' => 'Aula 102', 'capacidad' => 30],
            ['nombre' => 'Aula 201', 'capacidad' => 25],
            ['nombre' => 'Taller de Redes', 'capacidad' => 20],
            ['nombre' => 'Taller de Hardware', 'capacidad' => 15],
            ['nombre' => 'Biblioteca', 'capacidad' => 50],
            ['nombre' => 'Salón de Actos', 'capacidad' => 100],
        ];

        foreach ($aulas as $aula) {
            Aula::create($aula);
        }
    }
}
