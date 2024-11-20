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
        Schema::create('escolar', function (Blueprint $table) {
            $table->string('id_estudiante')->primary();
            $table->decimal('promedio', 5, 2);
            $table->boolean('materia_en_repeticion')->default(false);
            $table->foreign('id_estudiante')->references('id_numero_control')->on('estudiantes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escolar');
    }
};