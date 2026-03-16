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
        User::factory()->create([
            'name' => 'Profesor Admin',
            'email' => 'admin@admin.com'
        ]); 

        User::factory(5)->create();

        $this->call(AulaSeeder::class);

        $this->call(FranjaHorariaSeeder::class);

        Profesor::factory(10)->create();
    }
}
