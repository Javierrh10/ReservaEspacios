<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('profesor_id')->constrained('profesores');
            $table->foreignId('aula_id')->constrained('aulas');

            $table->date('fecha');
            $table->dateTime('hora_inicio');
            $table->dateTime('hora_fin');
            $table->string('grupo')->nullable();
            $table->string('motivo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
