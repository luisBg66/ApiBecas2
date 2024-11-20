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
        Schema::create('social', function (Blueprint $table) {
            $table->string('id_estudiante')->primary();
            $table->integer('integrantes_familia')->nullable();
            $table->foreign('id_estudiante')->references('id_numero_control')->on('estudiantes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social');
    }
};
