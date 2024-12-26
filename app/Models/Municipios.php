<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    use HasFactory;

    public function provincia()
    {
        return $this->belongsTo(Provincias::class);
    }

    public function alunos()
    {
        return $this->hasMany(Inscricao::class);
    }
}
