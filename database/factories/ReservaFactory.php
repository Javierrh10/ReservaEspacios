<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Aula;
use App\Models\Profesor;
use App\Models\FranjaHoraria;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'aula_id' => Aula::factory(),
            'franja_horaria_id' => FranjaHoraria::factory(),
            'profesor_id' => Profesor::factory(),
            'grupo' => $this->faker->randomElement(['1º DAW', '2º DAW', '1º ASIR', '2º ASIR', '1º SMR', '2º SMR']),
            'motivo' => $this->faker->sentence(3),
        ];
    }
}
