<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
        } elseif ($usuario->tipo === 'Diretor') {
            // Exibir apenas alguns usuários (defina a lógica de seleção)
            $user = User::all()->slice(1); // Skip o primeiro usuário
        }
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        $title = 'Atenção!';
        $text = "Tem certeza que dejesas excluir o Utilizador!?";
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
                Alert::success('Sucesso', 'Utilizador atualizado');
                return redirect()->back();
            } else {
                Alert::success('Sucesso', 'Utilizador adicionado com sucesso');
                return redirect()->back();
            }
        } else {
            Alert::error('Erro', 'Erro ao adicionar o utilizador');
            return redirect()->back();
        }
    }

    //função para deletar
    public function deletar($id)
    {
        User::find(Crypt::decrypt($id))->delete();
        Alert::success('Sucesso', 'Utilizador excluido com sucesso');
        return redirect()->back();
    }

    //função para alterar a senha so usuario
    public function updatePassword(Request $request)
    {
        // Validação da requisição (opcional, mas recomendada)
        $request->validate([
            'id' => 'required|exists:users,id', // Verifica se o ID existe no banco
            'password' => 'required|min:6|confirmed', // Verifica se a senha tem pelo menos 6 caracteres e se o campo 'password_confirmation' está presente
        ]);

        // Encontrar o usuário pelo ID fornecido
        $user = User::find($request->id);

        if ($user) {
            // Atualizar a senha do usuário
            $user->password = bcrypt($request->password); // Criptografar a nova senha
            $user->save(); // Salvar no banco

            // Retornar uma resposta de sucesso
            Alert::success('Sucesso', 'Senha atualizada com sucesso');
            return redirect()->back();
        } else {
            // Caso o usuário não seja encontrado
            Alert::error('Erro', 'Utilizador não encontrado');
            return redirect()->back();
        }
    }

    public function show()
    {

        $user = Auth::User();

        $funcionario = Funcionarios::where('Users_id', $user->id)->first();
        return view('pages.perfil', compact('user', 'funcionario'));
    }
}
