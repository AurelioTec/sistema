<?php

use App\Http\Controllers\ConfigIniController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PerfilAlunoController;
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


    Route::get('/', [HomeController::class, 'index'])->name('home');

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
    Route::delete('funcionario/excluir/{id}', [FuncionariosController::class, 'deletar'])->name('funcionario.excluir');
    //Rotas aluno
    Route::get('aluno/municipios/{id}', [InscricaoController::class, 'getMunicipios'])->name('municipios');
    Route::get('aluno/turmas/{classe}/{periodo}', [InscricaoController::class, 'getTurmas'])->name('turmas');
    Route::get('aluno/inscriao/{id}', [InscricaoController::class, 'getAlunoById'])->name('alunoId');
    Route::get('aluno', [InscricaoController::class, 'index'])->name('inscricao');
    Route::post('aluno', [InscricaoController::class, 'store'])->name('aluno.cadastrar');
    Route::get('aluno/excluir/{id}', [InscricaoController::class, 'deletar'])->name('aluno.excluir');
    Route::get('aluno/perfil/{id}', [PerfilAlunoController::class, 'show'])->name('perfil.aluno');
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
    Route::get('relatorio/matricula', [RelatorioController::class, 'getMatricula'])->name('relatorio.matricula');
    Route::get('relatorio/a/', [RelatorioController::class, 'getWarningAlert'])->name('relatrio.alerta');
});


Auth::routes();

Route::get('/home', action: function () {
    return redirect(to: '/');
})->name('home');
