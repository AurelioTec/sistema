<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    public function municipios()
    {
        return $this->belongsTo(Municipios::class, 'municipio_id');  // 'municipio_id' é o campo de chave estrangeira na tabela de alunos
    }

    // Model Inscricao
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'inscricaos_id');
    }
}
