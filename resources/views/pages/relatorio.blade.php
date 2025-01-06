@extends('base.app')
@section('titulo')
    -Home
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Relatorio</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 text-center">
                <div class="feature col ">
                    <div
                        class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-solid fa-people-roof fa-3x bg-dark border-1"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Aluno por turma</h3>
                    <p>Distribuição do número de alunos matriculados em uma turma.</p>
                    <a href="#getTurma" data-bs-toggle="modal" data-bs-target="#getTurma" class="icon-link">Abrir
                    </a>
                </div>
                <div class="feature col">
                    <div
                        class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-regular fa-address-book fa-3x bg-dark border-1"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Alunos Matriculados</h3>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence
                        and probably just keep going until we run out of words.</p>
                    <a href="#" class="icon-link">
                        Call to action
                        <svg class="bi">
                            <use xlink:href="#chevron-right" />
                        </svg>
                    </a>
                </div>
                <div class="feature col">
                    <div
                        class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <i class="fa-regular fa-address-card  fa-3x bg-dark border-1 "></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Ficha de matricula</h3>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence
                        and probably just keep going until we run out of words.</p>
                    <a href="#" class="icon-link">
                        Call to action
                        <svg class="bi">
                            <use xlink:href="#chevron-right" />
                        </svg>
                    </a>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" target="_blank"
                                    rel="noopener noreferrer">Pesquisar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
