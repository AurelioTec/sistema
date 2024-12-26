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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id(); // Adiciona uma coluna ID (chave primária)
            $table->string('nagente', 8);
            $table->string('nome', 120);
            $table->date('datanascimento');
            $table->enum('genero', ['M', 'F']);
            $table->string('telf', 15);
            $table->enum('habilitacao', ['Médio', 'Superior', 'Mestre', 'Doutor']);
            $table->string('categoria', 40);
            $table->string('funcao', 45);
            $table->foreignId('users_id')->constrained('users');
            $table->string('foto')->nullable(); // Adiciona a coluna foto, permitindo nulo
            $table->timestamps(); // Adiciona as colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
