<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultorios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('ubicacion', 100);
            $table->integer('capacidad');
            $table->string('telefono', 20)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('especialidad', 100);
            $table->string('estado', 20);
            $table->mediumtext('equipamiento')->nullable();
            $table->mediumtext('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultorios');
    }
};
