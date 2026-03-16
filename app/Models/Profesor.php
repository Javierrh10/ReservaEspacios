<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesores';

    protected $fillable = ['user_id', 'nombre', 'apellidos', 'email', 'departamento'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reservas() {
        return $this->hasMany(Reserva::class);
    }
}
