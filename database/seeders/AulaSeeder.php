<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Aula::create([
            'nombre' => 'Aula 101',
            'descripcion' => 'Aula equipada con proyector y pizarras blancas',
            'capacidad' => 30,
        ]);

        \App\Models\Aula::create([
            'nombre' => 'Taller de Informática',
            'descripcion' => 'Aula con ordenadores y acceso a internet',
            'capacidad' => 25,
        ]);

        \App\Models\Aula::create([
            'nombre' => 'Salón de Actos',
            'descripcion' => 'Gran espacio para conferencias y eventos',
            'capacidad' => 20,
        ]);
    }
}
