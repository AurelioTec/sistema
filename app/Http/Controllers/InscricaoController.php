<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Inscricao;
use App\Models\Municipios;
use App\Models\Provincias;
use App\Models\Turma;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class InscricaoController extends Controller
{
    public function index()
    {
        $alunos = Inscricao::with('municipios')
            ->where('estado', 'Pendente')
            ->get();
        // Obter o último ano letivo
        $lastYear = ConfigIni::latest('anoletivo')->first();

        $inscricao = Inscricao::with('municipios')->get();

        $title = 'Atenção!';
        $text = "Tens a certesa que desejas excluir o aluno!?";
        confirmDelete($title, $text);
        $userId = Auth::id();
        $turmaPorAno = Turma::where('anolectivo', date('Y'))->get();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        $provincias = Provincias::all();
        return view('pages.inscricao', compact('alunos', 'inscricao', 'funcionario', 'provincias', 'turmaPorAno'));
    }
    public function getMunicipios($id)
    {
        $municipios = Municipios::where('provincia_id', $id)->get();
        return response()->json($municipios);
    }

    public function getTurmas($classe, $periodo)
    {
        $turmas = Turma::where('classe', $classe)
            ->where('periodo', $periodo)
            ->get();
        return response()->json($turmas);
    }
    public function getAlunoById($id)
    {

        $inscricao = Inscricao::where('id', Crypt::decrypt($id))->first();
        $inscricao->datanascimento = Carbon::parse($inscricao->datanascimento)->format('d/m/y');
        return response()->json($inscricao);
    }


    public function store(Request $request)
    {
        $aluno = null;
        if (isset($request->id)) {
            //procurar um elemento no banco de dados usar o find
            $aluno = Inscricao::find($request->id);
        } else {
            $aluno = new Inscricao();
        }
        if (isset($request->foto)) {
            $imagem = $request->foto;
            $extencao = $imagem->extension();
            $imgNome = md5($imagem->getClientOriginalName() . strtotime('now')) . $extencao;
            $imagem->move(public_path('img/upload/aluno/'), $imgNome);
            $aluno->foto = $imgNome;
        }
        $aluno->nomealuno = $request->nomealuno;
        $aluno->municipio_id = $request->municipio;
        $aluno->datanascimento = $request->datanascimento;
        $aluno->municipio_id = $request->municipio;
        $aluno->genero = $request->genero;
        $aluno->doctipo = $request->doctipo;
        $aluno->docnumero = $request->docnumero;
        $aluno->dataemissao = $request->dataemissao;
        $aluno->nomepai = $request->nomepai;
        $aluno->nomemae = $request->nomemae;
        $aluno->morada = $request->cidade;
        $aluno->bairro = $request->bairro;
        $aluno->rua = $request->rua;
        $aluno->telf = $request->telf;
        $aluno->obs = $request->obs;
        $aluno->estado = 'Pendente';

        $aluno->save();
        if ($aluno) {
            if (isset($request->id)) {
                Alert::success('Sucesso', 'Dados do aluno atualizados');
                return redirect()->back();
            } else {
                Alert::success('Sucesso', 'Aluno inscrito com sucesso');
                return redirect()->back();
            }
        } else {
            Alert::error('Error', 'Erro ao inscrever o aluno');
            return redirect()->back();
        }
    }

    public function deletar($id)
    {
        $decryptedId = Crypt::decrypt($id);
        Inscricao::find($decryptedId)->delete();
        Alert::success('Sucesso', 'Aluno excluida!');
        return redirect()->back();
    }
}
