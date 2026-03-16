<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranjaHoraria extends Model
{
    protected $fillable = ['nombre', 'hora_inicio', 'hora_fin'];

    public function getHoraInicioFormateadaAttribute()
    {
        return substr($this->hora_inicio, 0, 5);
    }

    public function getHoraFinFormateadaAttribute()
    {
        return substr($this->hora_fin, 0, 5);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'franja_horaria_id');
    }
}

