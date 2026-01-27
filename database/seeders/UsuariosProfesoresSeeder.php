<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profesor;
use Illuminate\Support\Facades\Hash;

class UsuariosProfesoresSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Creamos un usuario base
        $user = User::create([
            'name' => 'root',
            'email' => 'root@institutodh.net',
            'password' => Hash::make('1234'),
        ]);

        // 2. Creamos el perfil de profesor vinculado a ese usuario
        Profesor::create([
            'user_id' => $user->id,
            'nombre' => 'Victor',
            'apellidos' => 'García Villarán',
            'email' => 'victorgarvilla@institutodh.net',
            'departamento' => 'Informática',
        ]);

        // 3. Creamos usuarios adicionales
        User::create([
            'name' => 'Maria López',
            'email' => 'maria.lopez@institutodh.net',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'Carlos Fernández',
            'email' => 'carlos.fernandez@institutodh.net',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'Ana Martínez',
            'email' => 'ana.martinez@institutodh.net',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'Pedro Sánchez',
            'email' => 'pedro.sanchez@institutodh.net',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'Laura García',
            'email' => 'laura.garcia@institutodh.net',
            'password' => Hash::make('1234'),
        ]);
    }
}