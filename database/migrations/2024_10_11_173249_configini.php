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
        Schema::create( 'configini',function (Blueprint $table) {
        $table->id();
        $table->string('escola', 120)->nullable(false);
        $table->enum('tipo', ['Colegio', 'Complexo', 'Escola primaria'])->nullable(false);
        $table->string('director', 80)->nullable(false);
        $table->string('pedagogico', 80)->nullable(false);
        $table->string('administrativo', 80)->nullable(false);
        $table->integer('salas')->nullable(false);
        $table->integer('anoletivo')->nullable(false);
        $table->enum('estado', ['Aberto', 'Encerrado'])->nullable(false);
        $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configini');
    }
};
