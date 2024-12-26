<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Matricula;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class RelatorioController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $turmas = Turma::all();
        $anoletivo = date('Y');
        $config = ConfigIni::where('anoletivo', $anoletivo)
            ->selectRaw('anoletivo, salas')
            ->get();
        if ($config->isEmpty()) {
            $anoletivo = date('Y') - 1;
            $config = ConfigIni::where('anoletivo', $anoletivo)
                ->selectRaw('anoletivo, salas')
                ->get();
        }
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        return view('pages.relatorio', compact('funcionario', 'turmas', 'config'));
    }

    public function show(Request $request)
    {
        $header = Matricula::with('turma')
        ->whereHas('turma', function ($query) use ($request) {
            $query->where('descricao', $request->turma)
                ->where('classe', $request->classe)
                ->where('periodo', $request->periodo);
        })
            ->first();

        $alunos = Matricula::with(['inscricao', 'turma', 'usuario'])
            ->whereHas('turma', function ($query) use ($request) {
                $query->where('descricao', $request->turma)
                    ->where('classe', $request->classe)
                    ->where('periodo', $request->periodo);
            })
            ->get();
        return view('relatorios.alunoturma', compact('alunos', 'request', 'header'));
    }

    public function getTurmas($classe, $periodo)
    {
        $turmas = Turma::where('classe', $classe)
            ->where('periodo', $periodo)
            ->get();
        return response()->json($turmas);
    }
}