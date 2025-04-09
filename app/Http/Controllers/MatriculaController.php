<?php

namespace App\Http\Controllers;

use App\Helpers\Funcoes;
use App\Models\Funcionarios;
use App\Models\Inscricao;
use App\Models\matricula;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        $matriculados = Matricula::with('inscricao', 'turma', 'usuario')->get();

        $title = 'Atenção!';
        $text = "Deseja aprovar a matricula do aluno!?";
        confirmDelete($title, $text);
        return view('pages.matricula', compact('matriculados', 'funcionario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $matricula = null;

        if (isset($request->id)) {
            // Buscar a matrícula existente
            $matricula = Matricula::find($request->id);
        } else {
            $matricula = new Matricula();
        }

        // Verificar se o aluno já está matriculado na mesma turma
        $existeMatricula = Matricula::where('inscricaos_id', $request->alunoId)
            ->where('turmas_id', $request->turma)
            ->where('estado', 'Ativo')
            ->exists();

        if ($existeMatricula) {
            // Se já estiver matriculado, exibe mensagem de erro
            Alert::error('Erro', 'Este aluno já está matriculado nesta turma.');
            return redirect()->back();
        }

        // Verificar o número de alunos já matriculados na turma
        $numAlunos = Matricula::where('turmas_id', $request->turma)->count();
        if ($numAlunos >= 50) {
            // Exibir mensagem se o limite foi alcançado
            Alert::error('Turma cheia', 'A turma selecionada já atingiu o limite de 50 alunos.');
            return redirect()->back();
        }

        // Obter o ano atual e inicial do nome
        $anoAtual = date('Y');
        $inicialNome = strtoupper(substr($request->nomeAluno, 0, 1));

        // Obter o maior número de matrícula existente no ano e inicial fornecidos
        $ultimoNumMatricula = Matricula::where('numatricula', 'like', "{$anoAtual}{$inicialNome}%")
            ->orderBy('numatricula', 'desc')
            ->value('numatricula');

        $nunmatricula = Funcoes::gerarNumeroMatricula($request->nomeAluno, $ultimoNumMatricula);

        // Tratamento de anexo
        if (isset($request->anexo)) {
            $request->validate([
                'anexo' => 'required|file|mimes:pdf|max:2048',
            ]);

            $doc = $request->file('anexo');
            $extensao = $doc->extension();
            $docNome = $request->nomeAluno . '.' . $extensao;
            $caminho = Storage::makeDirectory(public_path('/docs/upload/aluno/' . $inicialNome . '/'));

            // O método putFileAs irá criar automaticamente a pasta caso ela não exista
            Storage::disk('public')->putFileAs($caminho, $doc, $docNome);
            $matricula->anexo = $docNome;
        }

        $matricula->inscricaos_id = $request->alunoId;
        $matricula->turmas_id = $request->turma;
        $matricula->lestrangeira = $request->lestrangeira;
        $matricula->encarregado = $request->encarregado;
        $matricula->telfencarregado = $request->telfencarregado;
        $matricula->tipomatricula = "Novo";
        $matricula->estado = "Ativo";
        $matricula->numatricula = $nunmatricula;
        $matricula->datamatricula = Carbon::now()->toDateString();
        $matricula->users_id = $userId;

        // Alterar o estado da inscrição e salvar matrícula
        $inscricao = Inscricao::find($request->alunoId);
        if (!$inscricao) {
            Alert::error('Erro', 'Aluno não encontrado');
            return redirect()->back();
        }

        $inscricao->estado = 'Matriculado';
        $inscricao->save();
        $matricula->save();

        if ($matricula) {
            Alert::success('Sucesso', 'Aluno matriculado com sucesso');
            return redirect()->back();
        } else {
            Alert::error('Erro', 'Erro ao matricular o aluno');
            return redirect()->back();
        }
    }

/**
 * suspender a mtricula do aluno
 *
 * @param  mixed $id
 * @return void
 */
public function suspender($id){
    $idmatricula=Crypt::decrypt($id);
    $matricula = Matricula::findOrFail($idmatricula);
    $matricula->estado = 'Suspensa';
    $matricula->save();

    if ($matricula) {
        Alert::success('Sucesso', 'Matricula suspensa com sucesso');
        return redirect()->back();
    } else {
        Alert::error('Erro', 'Erro ao suspender a matricula');
        return redirect()->back();
    }
}

public function confirmar($id){
    $idmatricula=Crypt::decrypt($id);
    $matricula = Matricula::find($idmatricula);
    if(!$matricula ){
        Alert::success('Erro', 'Numero de Matricula não encontrada');
        return redirect()->back();
    }else{
    $matricula->estado = 'Aprovada';
    $matricula->save();
    Alert::success('Sucesso', 'Matricula aprovada com sucesso');
    return redirect()->back();
    }

}


}
