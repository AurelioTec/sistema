<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funcio = Funcionarios::all();
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        return view('pages.funcionario', compact('funcio', 'funcionario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //nagente 	nome 	datanascimento 	genero 	telf 	habilitacao 	categoria 	especialidade 	users_id 	foto
        $funcio = null;
        if (isset($request->id)) {
            //procurar um elemento no banco de dados usar o find
            $funcio = Funcionarios::find($request->id);
            $user = User::find($funcio->users_id);
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->save();
        } else {
            $user = new User();
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->password = bcrypt('123456');
            $user->tipo = "Tecnico";
            $user->save();
            $funcio = new Funcionarios();
            $funcio->users_id = $user->id;
        }
        if (isset($request->foto)) {
            $imagem = $request->foto;
            $extencao = $imagem->extension();
            $imgNome = md5($imagem->getClientOriginalName() . strtotime('now')) . $extencao;
            $imagem->move(public_path('img/upload/funcio/'), $imgNome);
            $funcio->foto = $imgNome;
        }
        $funcio->nagente = $request->nagente;
        $funcio->nome = $request->nome;
        $funcio->datanascimento = $request->datanascimento;
        $funcio->genero = $request->genero;
        $funcio->telf = $request->telf;
        $funcio->habilitacao = $request->habilitacao;
        $funcio->funcao = $request->funcao;
        $funcio->categoria = $request->categoria;
        $funcio->save();
        if ($funcio) {
            if (isset($request->id)) {
                Alert::success('Sucesso', 'Dados do funci onario atualizados');
                return redirect()->back();
            } else {
                Alert::success('Sucesso', 'Funcionario adicionado com sucesso');
                return redirect()->back();
            }
        } else {
            Alert::error('Error', 'Erro ao cadastrar o funcionario');
            return redirect()->back();
        }
    }
}
