<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('dni', 20)->unique();
            $table->date('fecha_nacimiento');
            $table->string('genero', 20);
            $table->string('estado_civil', 20);
            $table->string('celular', 20);
            $table->string('email', 100)->unique();
            $table->string('direccion', 250);
            $table->string('grupo_sanguineo', 5);
            $table->string('contacto_emergencia', 20);
            $table->mediumtext('enfermedades')->nullable();
            $table->mediumtext('alergias')->nullable();
            $table->mediumtext('antecedentes')->nullable();
            $table->mediumtext('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
