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
            //
            'fecha' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'aula_id' => Aula::all()->random()->id,
            'franja_horaria_id' => FranjaHoraria::all()->random()->id,
            'profesor_id' => Profesor::all()->random()->id,
            'grupo' => $this->faker->bothify('#º-???')
        ];
    }
}
