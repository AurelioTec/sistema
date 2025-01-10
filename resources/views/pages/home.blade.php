@extends('base.app')
@section('titulo')
    -Home
@endsection
@section('conteudo')
    <div class="container bg-light mt-1 mb-2">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Pagina inicial</h4>
        </div>
        <hr>
        <div class="row">
            <!-- Card 1: Total de Matrículas -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon text-info">
                            <i class="fas fa-graduation-cap text-info"></i>
                        </div>
                        <h5 class="card-title">Total de Matrículas</h5>
                        <p class="card-text">Número total de matrículas registradas</p>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 100%" role="progressbar"
                                aria-valuenow="{{ $total }}" aria-valuemin="0" aria-valuemax="1000"></div>
                        </div>
                        <p class="mt-2">{{ $total }} Matrículas</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Matrículas Ativas -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon text-success">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <h5 class="card-title">Matrículas Ativas</h5>
                        <p class="card-text">Porcentagem de matrículas ativas</p>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ ($MatriAtiva / $total) * 100 }}%"
                                role="progressbar" aria-valuenow="{{ $MatriAtiva }}" aria-valuemin="0"
                                aria-valuemax="{{ $total }}">
                            </div>
                        </div>
                        <p class="mt-2">{{ $MatriAtiva }} Matrículas Ativas</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Matrículas Novas -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon text-warning">
                            <i class="fas fa-hourglass-half text-warning"></i>
                        </div>
                        <h5 class="card-title">Matrículas Novas</h5>
                        <p class="card-text">Número de matrículas novas neste ano</p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{ ($MatriNova / $total) * 100 }}%"
                                role="progressbar" aria-valuenow="{{ $MatriNova }}" aria-valuemin="0"
                                aria-valuemax="{{ $total }}">
                            </div>
                        </div>
                        <p class="mt-2">{{ $MatriNova }} Matrículas Novas</p>
                    </div>
                </div>
            </div>

            <!-- Card 4: Matrículas por Turma -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon text-danger">
                            <i class="fas fa-chalkboard-teacher text-danger"></i>
                        </div>
                        <h5 class="card-title">Matrículas por Turma</h5>
                        <p class="card-text">Número de matrículas por turma</p>
                        <div class="list-group">
                            <p class="list-group-item"> {{ $total }} Matrículas : {{ $totalTurmasDif }} turmas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5: Total de Turmas -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon text-primary">
                            <i class="fas fa-chalkboard-teacher text-primary"></i>
                        </div>
                        <h5 class="card-title">Total de Turmas</h5>
                        <p class="card-text">Número total de turmas registradas</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 100%" role="progressbar"
                                aria-valuenow="{{ $totalTurmas }}" aria-valuemin="0" aria-valuemax="1000"></div>
                        </div>
                        <p class="mt-2">{{ $totalTurmas }} Turmas</p>
                    </div>
                </div>
            </div>

            <!-- Card 6: Turmas com Alunos -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon text-dark">
                            <i class="fas fa-users text-dark"></i>
                        </div>
                        <h5 class="card-title">Turmas com Alunos</h5>
                        <p class="card-text">Percentagem de turmas com alunos</p>
                        <div class="progress">
                            <div class="progress-bar bg-dark" style="width: {{ $porcentagem }}%" role="progressbar"
                                aria-valuenow="{{ $turmasComAlunos }}" aria-valuemin="0"
                                aria-valuemax="{{ $totalTurmas }}">
                            </div>
                        </div>
                        <p class="mt-2">{{ $turmaAlunosMatri }} Turmas com alunos</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
