@extends('base.app')
@section('titulo')
    -Relatorios
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Relatorios</h2>
            <div class="row">
                <div class="admin-dashboard">
                    <div class="icon">
                        <a href="#getTurma" data-bs-toggle="modal" data-bs-target="#getTurma" class="icon-link"><i
                                class="fas fa-users"></i></a>
                        <p>Alunos por turmas</p>
                    </div>
                    <div class="icon">
                        @if (Auth::check() && (Auth::user()->tipo === 'Admin' || Auth::user()->tipo === 'Diretor'))
                            <a href="{{ route('relatorio.usuario') }}" class="icon-link" target="_blank"
                                rel="noopener noreferrer">
                                <i class="fas fa-user-friends"></i></a>
                            <p>Usuários</p>
                        @else
                            <a href="{{ route('relatrio.alerta') }}" class="icon-link">
                                <i class="fas fa-user-friends"></i></a>
                        @endif
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
                        <i class="fas fa-user-graduate"></i>
                        <p>Alunos</p>
                    </div>
                    <div class="icon">
                        <a href="{{ route('relatorio.matricula') }}" class="icon-link" target="_blank"
                            rel="noopener noreferrer">
                            <i class="fas fa-graduation-cap"></i></a>
                        <p>Matriculas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Pesquisar aluno turma -->
    <div class="modal fade " id="getTurma" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg tela" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Buscar aluno/turma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form action="{{ route('relatorio.turmaluno') }}" id="FormAlunoTurma" method="GET"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf
                            <input type="hidden" name="sala" id="sala">
                            <div class="col-3">
                                <label for="classe" class="form-label">Classe</label>
                                <select id="classe" class="form-control" name="classe" required>
                                    <option value="7ª">7ª</option>
                                    <option value="8ª">8ª</option>
                                    <option value="9ª">9ª</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="periodo" class="form-label">Período</label>
                                <select id="periodo" class="form-control" name="periodo" required>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="turma" class="form-label">Turma</label>
                                <select class="form-select" id="turma" name="turma" required>
                                </select>
                            </div>

                            <div class="col-3">
                                <label for="anolectivo" class="form-label">Ano Letivo</label>
                                <select id="anolectivo" class="form-control" name="anolectivo" required>
                                    @foreach ($config as $conf)
                                        <option value="{{ $conf->anoletivo }}">{{ $conf->anoletivo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
