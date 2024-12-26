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
        Schema::create('inscricaos', function (Blueprint $table) {
            $table->id();
            $table->string('nomealuno', 120);
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->date('datanascimento', 120);
            $table->enum('genero', ['M', 'F']);
            $table->enum('doctipo', ['BI', 'Cedula', 'Assento', 'Passaporte']);
            $table->string('docnumero', 14);
            $table->date('dataemissao');
            $table->string('nomepai', 120)->nullable();
            $table->string('nomemae', 120)->nullable();
            $table->string('morada', 40)->nullable();
            $table->string('bairro', 70)->nullable();
            $table->string('rua', 120)->nullable();
            $table->string('telf', 15)->nullable();
            $table->string('foto', 255)->nullable();
            $table->longText('obs')->nullable();
            $table->timestamps();
        });

        /**
         *
         * `nome`, `idmunicipios`, `datanascimento`, `genero`, `doctipo`, `docnumero`, `dataemissao`, `nomepai`, `nomemae`, `munimorada`, `bairro`, `rua`, `telefone`, `foto`, `obs`
         */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricaos');
    }
};
