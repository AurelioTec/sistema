<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //função resouce que traz os dados do banco
    public function index()
    {

        $usuario = Auth::User();
        //trazer todos os dados do banco de dados
        if ($usuario->tipo === 'Admin') {
            // Exibir todos os usuários
            $user = User::all();
        } elseif ($usuario->tipo === 'Director') {
            // Exibir apenas alguns usuários (defina a lógica de seleção)
            $user = User::all()->slice(1); // Substitua 'condicao_especifica' pela lógica que você precisa
        }
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        $title = 'Atenção!';
        $text = "Dejesas apagar o usuario?";
        confirmDelete($title, $text);
        return view('pages.usuario', compact('user', 'funcionario'));
    }
    //função para inserir e atualizar dados do banco.
    public function store(Request $request)
    {
        $user = null;
        if (isset($request->id)) {
            //procurar um elemento no banco de dados usar o find
            $user = User::find($request->id);
        } else {
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->tipo . '123');
        $user->tipo = $request->tipo;
        $user->save();
        if ($user) {
            if (isset($request->id)) {
                Alert::success('Sucesso', 'Usuario atualizado');
                return redirect()->back();
            } else {
                Alert::success('Sucesso', 'Usuario adicionado com sucesso');
                return redirect()->back();
            }
        } else {
            Alert::error('Erro', 'Erro ao cadastrar o Usuario');
            return redirect()->back();
        }
    }

    //função para deletar
    public function deletar($id)
    {
        User::find($id)->delete();
        Alert::success('Sucesso', 'Usuario apagado com sucesso');
        return redirect()->back();
    }
}
