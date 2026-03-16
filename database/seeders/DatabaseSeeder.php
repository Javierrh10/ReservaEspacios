<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profesor;
use Database\Seeders\FranjaHorariaSeeder;
use Database\Seeders\AulaSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Profesor Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $aulas = ['Aula 1', 'Aula 2', 'Taller de Redes'];
        foreach ($aulas as $a) {
            \App\Models\Aula::create(['nombre' => $a, 'capacidad' => 35]);
        }

        $franjas = ['1ª Hora', '2ª Hora', '3ª Hora', '4ª Hora', '5ª Hora', '6ª Hora'];
        foreach ($franjas as $f) {
            \App\Models\FranjaHoraria::create(['nombre' => $f, 'hora_inicio' => '08:00', 'hora_fin' => '09:00']);
        }

        \App\Models\User::factory(10)->create()->each(function ($user) {
            \App\Models\Profesor::factory()->create(['user_id' => $user->id]);
        });

        \App\Models\Reserva::factory(20)->create();
    }
}
