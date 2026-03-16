<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    //
    protected $fillable = ['profesor_id', 'aula_id', 'fecha', 'franja_horaria_id', 'grupo', 'motivo'];

    public function profesor() {
        return $this->belongsTo(Profesor::class);
    }

    public function aula() {
        return $this->belongsTo(Aula::class);
    }

    public function franja() {
        return $this->belongsTo(FranjaHoraria::class, 'franja_horaria_id');
    }
}
