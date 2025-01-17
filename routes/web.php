<?php

use App\Http\Controllers\ConfigIniController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UserController;
use App\Models\Funcionarios;
use App\Models\Matricula;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('sair', function () {
    Auth::logout();
    return view('auth.login');
})->name('sair');

Route::group(['middleware' => "auth"], function () {


    Route::get('/', function () {
        $user = Auth::user(); // Obtém o usuário autenticado
        $userId = Auth::id();
        // Total de matrículas
        $total = Matricula::count();

        // Matrículas ativas
        $MatriAtiva = Matricula::where('estado', 'Ativo')->count();

        // Matrículas do tipo "Novo"
        $MatriNova = Matricula::where('tipomatricula', 'Novo')->count();

        // Contar o total de turmas existentes
        $totalTurmas = Turma::count();

        // Contar quantas turmas têm alunos matriculados
        $turmasComAlunos = Matricula::select('turmas_id', DB::raw('count(*) as total'))
            ->groupBy('turmas_id')
            ->get();
        $turmaAlunosMatri = $turmasComAlunos->count();

        // Se desejar também saber a quantidade total de alunos matriculados por turma, como já estava no seu código
        $MatriPorTurma = Matricula::select('turmas_id', DB::raw('count(*) as total'))
            ->groupBy('turmas_id')
            ->get();
        $porcentagem = $totalTurmas > 0 ? ($turmaAlunosMatri / $totalTurmas) * 100 : 0;
        $totalTurmasDif = Matricula::distinct('turmas_id')->count('turmas_id');


        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        return view('pages.home', compact(
            'user',
            'funcionario',
            'total',
            'MatriAtiva',
            'MatriNova',
            'porcentagem',
            'MatriPorTurma',
            'totalTurmas',
            'totalTurmasDif',
            'turmasComAlunos',
            'turmaAlunosMatri',
        ));
    });

    //rotas Configini

    Route::get('configini', [ConfigIniController::class, 'index'])->name('config');
    Route::post('configini', [ConfigIniController::class, 'store'])->name('config.guardar');
    Route::delete('configini/encerrar/{id}', [ConfigIniController::class, 'encerrar'])->name('config.encerrar');
    //Rotas Usuarios
    Route::get('utilizador', [UserController::class, 'index'])->name('utilizador');
    Route::post('utilizador/cadastrar', [UserController::class, 'store'])->name('utilizador.cadastrar');
    Route::post('utilizador/updatepass', [UserController::class, 'updatePassword'])->name('utilizador.update');
    Route::post('Utilizador/updatefoto', [FuncionariosController::class, 'updateProfilePicture'])->name('utilizador.updatefoto');
    Route::get('Utlizador/perfil', [UserController::class, 'show'])->name('utilizador.perfil');
    Route::delete('Utilizador/excluir/{id}', [UserController::class, 'deletar'])->name('utilizador.excluir');
    //Rotas Funcionarios
    Route::get('funcionario', [FuncionariosController::class, 'index'])->name('funcionario');
    Route::post('funcionario', [FuncionariosController::class, 'store'])->name('funcionario.cadastrar');
    Route::delete('delete/{id}', [FuncionariosController::class, 'deletar'])->name('funcionario.apagar');
    //Rotas Inscrição
    Route::get('aluno/municipios/{id}', [InscricaoController::class, 'getMunicipios'])->name('municipios');
    Route::get('aluno/turmas/{classe}/{periodo}', [InscricaoController::class, 'getTurmas'])->name('turmas');
    Route::get('aluno/inscriao/{id}', [InscricaoController::class, 'getAlunoById'])->name('alunoId');
    Route::get('aluno', [InscricaoController::class, 'index'])->name('inscricao');
    Route::post('aluno', [InscricaoController::class, 'store'])->name('aluno.cadastrar');
    // Route::delete('delete/{id}', [FuncionariosController::class, 'deletar'])->name('funcionario.apagar');
    //Rotas turma
    Route::get('turma', [TurmaController::class, 'index'])->name('turma');
    Route::post('turma', [TurmaController::class, 'store'])->name('turma.cadastrar');
    Route::delete('excluir/{id}', [TurmaController::class, 'deletar'])->name('turma.excluir');
    //Rotas matricula
    Route::get('matricula', [MatriculaController::class, 'index'])->name('matricula');
    Route::post('aluno/matricular', [MatriculaController::class, 'store'])->name('aluno.matricular');
    //Route::delete('delete/{id}', [FuncionariosController::class, 'deletar'])->name('funcionario.apagar');
    //Rotas Relatorio
    Route::get('relatorio', [RelatorioController::class, 'index'])->name('relatorio');
    Route::get('relatorio/turma/{classe}/{periodo}', [RelatorioController::class, 'getTurmas'])->name('relatorio.turma');
    Route::get('relatorio/turma', [RelatorioController::class, 'show'])->name('relatorio.turmaluno');
    Route::get('relatorio/ficha/{anoletivo}/{id}', [RelatorioController::class, 'getFicha'])->name('relatorio.ficha');
    Route::get('relatorio/usuario', [RelatorioController::class, 'getUser'])->name('relatorio.usuario');
});


Auth::routes();

Route::get('/home', action: function () {
    return redirect(to: '/');
})->name('home');
