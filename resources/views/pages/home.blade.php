@extends('base.app')
@section('titulo')
    -Home
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Pagina inicial</h4>
        </div>
        <hr>
        <div class="row">
            <div class="admin-dashboard">
                <div class="icon">
                    <a href="#" target="_blank" rel="noopener noreferrer"> <i class="fas fa-users"></i></a>
                    <p>Funcionarios</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-friends"></i>
                    <p>Usuários</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cogs"></i>
                    <p>Configurações</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                    <p>Estatísticas</p>
                </div>
            </div>
            <div class="admin-dashboard">
                <div class="icon">
                    <i class="fa fa-home-user"></i>
                    <p>Turmas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pencil"></i>
                    <p>Inscrições</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                    <p>Matriculas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-edit"></i>
                    <p>Relatórios</p>
                </div>
            </div>
        </div>
    </div>
@endsection
