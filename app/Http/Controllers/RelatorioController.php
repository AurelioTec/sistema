<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Matricula;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Builder\Function_;

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

    public function getFicha($anoletivo, $id)
    {
        $iddesc = Crypt::decryptString($id);

        // Buscar o aluno por ID, considerando a turma e o ano letivo
        $aluno = Matricula::with(['inscricao.municipios', 'turma', 'usuario'])
            ->whereHas('turma', function ($query) use ($anoletivo) {
                $query->where('anolectivo', $anoletivo);
            })
            ->where('id', $iddesc) // Filtra diretamente na consulta ao banco de dados
            ->first(); // Retorna apenas o primeiro resultado encontrado

        return view('relatorios.fichaaluno', compact('aluno'));
    }



    public function getTurmas($classe, $periodo)
    {
        $turmas = Turma::where('classe', $classe)
            ->where('periodo', $periodo)
            ->get();
        return response()->json($turmas);
    }
}
