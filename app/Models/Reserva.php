<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
    protected $fillable = ['profesor_id', 'aula_id', 'fecha', 'hora_inicio', 'hora_fin', 'grupo', 'motivo'];

    public function profesor() {
        return $this->belongsTo(Profesor::class);
    }

    public function aula() {
        return $this->belongsTo(Aula::class);
    }
}
