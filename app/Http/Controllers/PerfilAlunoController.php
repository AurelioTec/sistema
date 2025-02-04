<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\Inscricao;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PerfilAlunoController extends Controller
{
    public function show($id)
    {
        // Descriptografando o ID
        $decryptedId = Crypt::decrypt($id);

        // Obter os dados do aluno (Inscrição e Matrícula)
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id',  $userId)->first(); // Acessa o funcionário relacionado
        $aluno = Inscricao::with('municipios')->where('id', $decryptedId)->first();

        $matricula = Matricula::where('inscricaos_id', $aluno->id)->first();


        // Passando as variáveis para a view
        return view('pages.perfilAluno', compact('aluno', 'matricula', 'funcionario'));
    }
}
