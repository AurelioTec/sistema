<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Matricula;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Exceptions;
use PhpParser\Node\Stmt\TryCatch;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;

class RelatorioController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $turmas = Turma::all();
        $ultimoAno = ConfigIni::orderBy('anoletivo', 'desc') // Ordena por anoletivo decrescente
            ->selectRaw('anoletivo')                // Seleciona os campos necessários
            ->first();                                     // Pega o primeiro registro

        $config = ConfigIni::where('anoletivo', $ultimoAno->anoletivo)
            ->selectRaw('anoletivo, salas')
            ->get();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        return view('pages.relatorio', compact('funcionario', 'turmas', 'config'));
    }

    public function show(Request $request)
    {
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
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
                ->get()
                ->sortBy(function ($matricula) {
                    return $matricula->inscricao->nomealuno;
                });
$ultimoAno = ConfigIni::orderBy('anoletivo', 'desc') // Ordena por anoletivo decrescente
            ->selectRaw('anoletivo')                // Seleciona os campos necessários
            ->first();                                     // Pega o primeiro registro
        $config = ConfigIni::where('anoletivo', $ultimoAno->anoletivo)
            ->selectRaw('anoletivo, salas')
            ->get();
             if ($header) {
                return view('pages.alunoturma', compact('alunos', 'request', 'header','funcionario','config'));
             }   else {
                Alert::warning('Atenção', 'Turma sem aluno!');
                return redirect()->back();
             }
            
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

    public function getUser()
    {
        $usuario = Auth::User();
        //trazer todos os dados do banco de dados
        if ($usuario->tipo === 'Admin') {
            // Exibir todos os usuários
            $user = User::all();
        } elseif ($usuario->tipo === 'Diretor') {
            // Exibir apenas alguns usuários (defina a lógica de seleção)
            $user = User::all()->slice(1); // Substitua 'condicao_especifica' pela lógica que você precisa
        }

        return view('relatorios.listausuario', compact('user'));
    }

    public function getMatricula()
    {
        $matriculados = Matricula::with('inscricao', 'turma', 'usuario')->get();
        return view('relatorios.listalunomatri', compact('matriculados'));
    }
    public function getWarningAlert()
    {
        Alert::warning('Atenção', 'Você não tem permissão para emitir este relatorio.');
        return redirect()->back();
    }
}
