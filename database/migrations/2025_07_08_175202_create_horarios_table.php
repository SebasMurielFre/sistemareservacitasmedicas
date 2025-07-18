<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('dia', 100);
            $table->time('hora_inicio');
            $table->time('hora_fin');

            $table->foreignId('doctor_id')
                ->constrained('doctors')
                ->onDelete('cascade');

            $table->foreignId('consultorio_id')
                ->constrained('consultorios')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
