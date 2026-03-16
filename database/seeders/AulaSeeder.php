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
        //
        for ($i = 1; $i <= 10; $i++) {
            Aula::create([
                'nombre' => "Aula $i",
                'capacidad' => rand(20, 35),
            ]);
        }
    }
}
