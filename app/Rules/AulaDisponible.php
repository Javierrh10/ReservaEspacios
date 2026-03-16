<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Reserva;

class AulaDisponible implements ValidationRule
{
    protected $aulaId;
    protected $fecha;
    protected $franjaId;
    protected $ignoreId;

    public function __construct($aulaId, $fecha, $franjaId, $ignoreId = null)
    {
        $this->aulaId = $aulaId;
        $this->fecha = $fecha;
        $this->franjaId = $franjaId;
        $this->ignoreId = $ignoreId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Reserva::where('aula_id', $this->aulaId)
            ->where('fecha', $this->fecha)
            ->where('franja_horaria_id', $this->franjaId);

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('Lo siento, este aula ya está reservada para esa fecha y tramo horario.');
        }
    }
}
