<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $config = ConfigIni::find($request->id);
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
        $result = ConfigIni::where([
            ['anoletivo', $request->anoletivo],
            ['estado', 'Aberto']
        ])->exists();
        if ($result) {
            Alert::warning('Atenção', 'Ano lectivo ja está aberto');
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
        $config = ConfigIni::find($id);
        $config->estado = "Encerrado";
        $config->save();
        Alert::success('Sucesso', 'Ano lectivo encerrado!');
        return redirect()->back();
    }

    //função para deletar
    public function deletar($id)
    {
        Funcionarios::find($id)->delete();
        Alert::success('Sucesso', 'Funcionario eliminado!');
        return redirect()->back();
    }
}
