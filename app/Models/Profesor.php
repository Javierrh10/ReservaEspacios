<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    //
    protected $table = 'profesores';

    protected $fillable = ['user_id', 'nombre', 'apellidos', 'email', 'departamento'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reservas() {
        return $this->hasMany(Reserva::class);
    }
}
