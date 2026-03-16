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
        // 1. Franjas Horarias
        $this->call(FranjaHorariaSeeder::class);

        // 2. Aulas
        $this->call(AulaSeeder::class);

        // 3. Admin User & Profesor Profile
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin Sistema',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Profesor::create([
            'user_id' => $admin->id,
            'nombre' => 'Admin',
            'apellidos' => 'Sistema',
            'email' => 'admin@admin.com',
            'departamento' => 'TIC',
        ]);

        // 4. Profesores adicionales con sus usuarios
        \App\Models\User::factory(10)->create()->each(function ($user) {
            \App\Models\Profesor::factory()->create([
                'user_id' => $user->id,
                'nombre' => $user->name,
                'email' => $user->email,
            ]);
        });

        // 5. Reservas aleatorias
        $profesores = \App\Models\Profesor::all();
        $aulas = \App\Models\Aula::all();
        $franjas = \App\Models\FranjaHoraria::all();

        for ($i = 0; $i < 30; $i++) {
            \App\Models\Reserva::create([
                'fecha' => now()->addDays(rand(0, 14))->format('Y-m-d'),
                'aula_id' => $aulas->random()->id,
                'profesor_id' => $profesores->random()->id,
                'franja_horaria_id' => $franjas->random()->id,
                'grupo' => collect(['1º DAW', '2º DAW', '1º ASIR', '2º ASIR'])->random(),
                'motivo' => 'Clase teórica/práctica',
            ]);
        }
    }
}
