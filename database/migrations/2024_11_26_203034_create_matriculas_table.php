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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->string('numatricula', 8)->unique(); // Número da matrícula
            $table->foreignId('inscricaos_id')->constrained()->onDelete('cascade'); // ID inscrição do aluno (chave estrangeira)
            $table->foreignId('turmas_id')->constrained()->onDelete('cascade'); // ID da turma (chave estrangeira)
            $table->string('lestrangeira', 50)->nullable(); // Língua estrangeira
            $table->date('datamatricula'); // Data da matrícula
            $table->string('encarregado', 120)->nullable(); // Nome do encarregado
            $table->string('telfencarregado', 15)->nullable(); // Telefone do encarregado
            $table->string('anexo')->nullable(); // Caminho do arquivo de anexo
            $table->foreignId('users_id')->constrained()->onDelete('cascade'); // ID do usuário que registrou (chave estrangeira)
            $table->enum('tipomatricula', ['Novo', 'Repetente'])->default('Novo'); // Tipo de matrícula
            $table->enum('estado', ['Ativo', 'Inativo', 'Transferido'])->default('Ativo'); // Estado da matrícula
            $table->timestamps();
            $table->foreignId('inscricaos_id')->constrained()->onDelete('cascade'); // A chave estrangeira para 'inscricoes'
            $table->foreignId('turmas_id')->constrained()->onDelete('cascade'); // A chave estrangeira para 'turmas'
            $table->foreignId('users_id')->constrained()->onDelete('cascade'); // A chave estrangeira para 'users'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
