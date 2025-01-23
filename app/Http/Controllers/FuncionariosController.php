<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class FuncionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->tipo === "Diretor") {
            $funcio = Funcionarios::with('user')
                ->where('funcao', '!=', 'Admin Super Geral')->get();;
        } elseif ($user->tipo === "Admin") {
            $funcio = Funcionarios::with('user')->get();
        }
        $title = 'Atenção!';
        $text = "Tem certeza que dejesas excluir o funcionarios!?";
        confirmDelete($title, $text);
        $funcionario = Funcionarios::where('Users_id', Auth::id())->first(); // Acessa o funcionário relacionado
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
            $user->password = bcrypt($user->tipo . '123');
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

    public function updateProfilePicture(Request $request)
    {
        // Validação da requisição (opcional)
        $request->validate([
            'id' => 'required|exists:users,id', // Verifica se o ID do usuário existe
            'foto' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // Verifica se a imagem é válida
        ]);

        // Encontrar o usuário
        $user = User::find($request->id);
        $funcio = Funcionarios::where('users_id', $user->id)->first();

        if ($user && $funcio) {
            // Verificar se o arquivo de imagem foi enviado
            if ($request->hasFile('foto')) {
                // Remover a foto antiga (se houver)
                if ($funcio->foto && file_exists(public_path('img/upload/funcio/' . $funcio->foto))) {

                    unlink(public_path('img/upload/funcio/' . $funcio->foto));
                }

                // Obter a nova imagem
                $imagem = $request->foto;
                $extencao = $imagem->extension();
                $imgNome = md5($imagem->getClientOriginalName() . strtotime('now')) . '.' . $extencao;

                // Salvar a nova foto no diretório de upload
                $imagem->move(public_path('img/upload/funcio/'), $imgNome);

                // Atualizar o caminho da foto no banco de dados
                $funcio->foto = $imgNome;
                $funcio->save();

                // Retornar uma resposta de sucesso
                Alert::success('Sucesso', 'Foto de perfil atualizada com sucesso');
                return redirect()->back();
            } else {
                // Se a foto não for enviada
                Alert::error('Erro', 'Nenhuma foto enviada');
                return redirect()->back();
            }
        } else {
            // Se o usuário ou o funcionário não for encontrado
            Alert::error('Erro', 'Usuário ou funcionário não encontrado');
            return redirect()->back();
        }
    }

    public function deletar($id)
    {
        Funcionarios::find(Crypt::decrypt($id))->delete();
        Alert::success('Sucesso', 'Funcionario excluida!');
        return redirect()->back();
    }
}
