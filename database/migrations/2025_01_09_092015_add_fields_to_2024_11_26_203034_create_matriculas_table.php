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
        Schema::table('matriculas', function (Blueprint $table) {
            $table->enum('resultado', ['Aprovado', 'Reprovado'])->nullable(); // Resultado do ano lectivo atual
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matriculas', function (Blueprint $table) {
            $table->enum('resultado', ['Aprovado', 'Reprovado'])->nullable();; // Resultado do ano lectivo atual
        });
    }
};
