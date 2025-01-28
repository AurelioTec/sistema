<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\Inscricao;
use App\Models\Matricula;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user(); // Obtém o usuário autenticado
        $userId = Auth::id();
        // Total de matrículas
        $total = Matricula::count();

        // Matrículas ativas
        $MatriAtiva = Matricula::where('estado', 'Ativo')->count();
        // Matrículas por genero


        $countG = DB::table('matriculas')
            ->join('inscricaos', 'matriculas.inscricaos_id', '=', 'inscricaos.id')
            ->where('inscricaos.genero', 'F')
            ->where('inscricaos.estado', 'Matriculado')
            ->count('matriculas.id');

        // Matrículas do tipo "Novo"
        $MatriNova = Matricula::where('tipomatricula', 'Novo')->count();

        // Contar o total de turmas existentes
        $totalTurmas = Turma::count();

        // Contar quantas turmas têm alunos matriculados
        $turmasComAlunos = Matricula::select('turmas_id', DB::raw('count(*) as total'))
            ->groupBy('turmas_id')
            ->get();
        $turmaAlunosMatri = $turmasComAlunos->count();

        // Se desejar também saber a quantidade total de alunos matriculados por turma, como já estava no seu código
        $MatriPorTurma = Matricula::select('turmas_id', DB::raw('count(*) as total'))
            ->groupBy('turmas_id')
            ->get();
        $porcentagem = $totalTurmas > 0 ? ($turmaAlunosMatri / $totalTurmas) * 100 : 0;
        $totalTurmasDif = Matricula::distinct('turmas_id')->count('turmas_id');


        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        return view('pages.home', compact(
            'user',
            'countG',
            'funcionario',
            'total',
            'MatriAtiva',
            'MatriNova',
            'porcentagem',
            'MatriPorTurma',
            'totalTurmas',
            'totalTurmasDif',
            'turmasComAlunos',
            'turmaAlunosMatri',
        ));
    }
}
