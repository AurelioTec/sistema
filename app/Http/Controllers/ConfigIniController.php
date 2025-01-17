<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigIniController extends Controller
{
    public function index()
    {
        //trazer todos os dados do banco de dados
        $config = ConfigIni::all();
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado

        $title = 'Atenção!';
        $text = "Tens a certesa que desejas encerrar o ano letivo!?";

        confirmDelete($title, $text);
        return view('pages.configini', compact('config', 'funcionario'));
    }
    public function store(Request $request)
    {
        $config = null;
        if (isset($request->id)) {
            //procurar um elemento no banco de dados usar o find
            $config = ConfigIni::find($request->id)->last();
        } else {
            $config = new ConfigIni();
        }
        $config->escola = $request->escola;
        $config->tipo = $request->tipo;
        $config->salas = $request->salas;
        $config->anoletivo = $request->anoletivo;
        $config->director = $request->diretor;
        $config->pedagogico = $request->pedagogico;
        $config->administrativo = $request->administrativo;
        $config->estado = "Aberto";
        $result = ConfigIni::where('estado', 'Aberto')->exists();
        if ($result) {
            Alert::warning('Atenção', 'Encerrar ano lectivo aberto');
            return redirect()->back();
        } else {
            $config->save();
            if ($config) {
                if (isset($request->id)) {
                    Alert::success('Sucesso', 'Dados lectivos atualizados');
                    return redirect()->back();
                } else {
                    Alert::success('Sucesso', 'Aberto ano letivo');
                    return redirect()->back();
                }
            } else {
                Alert::error('Erro', 'Erro ao abrir ano letivo');
                return redirect()->back();
            }
        }
    }

    public function encerrar($id)
    {
        $config = ConfigIni::find(Crypt::decrypt($id));
        $lastYear = ConfigIni::latest('anoletivo')->first();
        // Recupere todas as matrículas do ano letivo atual
        $matriculas = Matricula::whereHas('turma', function ($query) use ($lastYear) {
            $query->where('anolectivo', $lastYear->anoletivo);
        })->get();
        // Verifique se todos os alunos têm o campo de "resultado" preenchido
        $resultado = $matriculas->filter(function ($matricula) {
            // Substitua 'resultado' pelo nome real do campo ou relacional relacionado ao resultado
            return !empty($matricula->resultado);
        });

        if ($resultado->count() === $matriculas->count()) {
            // Todos os alunos têm resultado preenchido
            $config->estado = "Encerrado";
            $config->save();
            Alert::success('Sucesso', 'Ano lectivo encerrado!');
            return redirect()->back();
        } else {
            Alert::warning('Atenção', 'Alunos com reultado em falta');
            return redirect()->back();
        }
    }

    //função para deletar
    public function deletar($id)
    {
        Funcionarios::find($id)->delete();
        Alert::success('Sucesso', 'Funcionario eliminado!');
        return redirect()->back();
    }
}
