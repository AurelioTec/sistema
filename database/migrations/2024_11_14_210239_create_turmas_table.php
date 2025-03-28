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
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('classe',2);
            $table->string('codigo', 5); // Código da turma
            $table->char('descricao'); // Descrição da turma
            $table->string('periodo', 5); // Período da turma (exemplo: "manhã", "tarde")
            $table->integer('sala'); // Sala da turma
            $table->year('anolectivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
