<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    // Relação com o aluno (chave estrangeira 'inscricaos_id' na tabela 'matriculas')
    public function inscricao()
    {
        return $this->belongsTo(Inscricao::class, 'inscricaos_id');
    }

    public function municipio()
    {
        return $this->hasOneThrough(Municipios::class, Inscricao::class, 'id', 'id', 'inscricao_id', 'municipio_id');
    }

    // Relação com a turma
    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turmas_id');
    }

    // Relação com o usuário
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
