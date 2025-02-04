@extends('base.app')
@section('titulo')
    -Home
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-3 ">
            <h4 class="mb-0">Pagina inicial</h4>
        </div>
        <hr>
        <div class="row mt-3">
            <!-- Card 1: Total de Matrículas -->
            <div class="col-md-3 mb-3 " style="height: 200px">
                <div class="card shadow-sm"style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-info">
                            <i class="fas fa-graduation-cap text-info"></i>
                        </div>
                        <h6 class="card-title">Total de Matrículas</h6>
                        <p class="card-text" style=" font-size: 10pt">Número total de matrículas registradas</p>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 100%; " role="progressbar"
                                aria-valuenow="{{ $total }}" aria-valuemin="0" aria-valuemax="1000"></div>
                        </div>
                        <p class="mt-2" style="font-size: 10pt;">{{ $total }} Matrículas</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Matrículas Ativas -->
            <div class="col-md-3 mb-3"style="height: 200px">
                <div class="card shadow-sm" style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-success">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <h6 class="card-title">Matrículas Ativas</h6>
                        <p class="card-text" style="font-size: 10pt;">Porcentagem de matrículas ativas</p>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ ($MatriAtiva / $total) * 100 }}%"
                                role="progressbar" aria-valuenow="{{ $MatriAtiva }}" aria-valuemin="0"
                                aria-valuemax="{{ $total }}">
                            </div>
                        </div>
                        <p class="mt-2" style="font-size: 10pt;">{{ $MatriAtiva }} Matrículas Ativas</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Matrículas Novas -->
            <div class="col-md-3 mb-3" style="height: 200px">
                <div class="card shadow-sm" style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-warning">
                            <i class="fas fa-hourglass-half text-warning"></i>
                        </div>
                        <h6 class="card-title">Matrículas Novas</h6>
                        <p class="card-text" style="font-size: 10pt;">Número de matrículas novas neste ano</p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{ ($MatriNova / $total) * 100 }}%"
                                role="progressbar" aria-valuenow="{{ $MatriNova }}" aria-valuemin="0"
                                aria-valuemax="{{ $total }}">
                            </div>
                        </div>
                        <p class="mt-2" style="font-size: 10pt;">{{ $MatriNova }} Matrículas Novas</p>
                    </div>
                </div>
            </div>

            <!-- Card 4: Matrículas por Turma -->
            <div class="col-md-3 mb-3" style="height: 200px">
                <div class="card shadow-sm" style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-danger">
                            <i class="fas fa-chalkboard-teacher text-danger"></i>
                        </div>
                        <h6 class="card-title">Matrículas por Turma</h6>
                        <p class="card-text" style="font-size: 10pt;">Número de matrículas por turma</p>
                        <div class="list-group">
                            <p class="list-group-item" style="font-size: 10pt;"> {{ $total }}Matrículas:
                                {{ $totalTurmasDif }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5: Total de Turmas -->
            <div class="col-md-3" style="height: 200px">
                <div class="card shadow-sm" style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-primary">
                            <i class="fas fa-chalkboard-teacher text-primary"></i>
                        </div>
                        <h6 class="card-title">Total de Turmas</h6>
                        <p class="card-text" style="font-size: 10pt;">Número total de turmas registradas</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 100%" role="progressbar"
                                aria-valuenow="{{ $totalTurmas }}" aria-valuemin="0" aria-valuemax="1000"></div>
                        </div>
                        <p class="mt-2" style="font-size: 10pt;">{{ $totalTurmas }} Turmas</p>
                    </div>
                </div>
            </div>

            <!-- Card 6: Turmas com Alunos -->
            <div class="col-md-3" style="height: 200px">
                <div class="card shadow-sm" style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-dark">
                            <i class="fas fa-users text-dark"></i>
                        </div>
                        <h6 class="card-title">Turmas com Alunos</h6>
                        <p class="card-text" style="font-size: 10pt;">Percentagem de turmas com alunos</p>
                        <div class="progress">
                            <div class="progress-bar bg-dark" style="width: {{ $porcentagem }}%" role="progressbar"
                                aria-valuenow="{{ $turmasComAlunos }}" aria-valuemin="0"
                                aria-valuemax="{{ $totalTurmas }}">
                            </div>
                        </div>
                        <p class="mt-2" style="font-size: 10pt;">{{ $turmaAlunosMatri }} Turmas com alunos</p>
                    </div>
                </div>
            </div>
            <!-- Card 7: Total de alunos do genero masculino-->
            <div class="col-md-3" style="height: 200px">
                <div class="card shadow-sm" style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-danger">
                            <i class="fa-solid fa-person-dress" style="color: rgb(236, 30, 181)"></i>
                        </div>
                        <h6 class="card-title">Total Femenino</h6>
                        <p class="card-text" style="font-size: 10pt;">Total de alunos do genero Femenino</p>
                        <div class="list-group">
                            <p class="list-group-item" style="font-size: 10pt;"> {{ $countG }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 8: Total de alunos do genero masculino -->
            <div class="col-md-3" style="height: 200px">
                <div class="card shadow-sm" style="height: 200px">
                    <div class="card-body text-center">
                        <div class="icon text-danger">
                            <i class="fas fa-male text-primary"></i>
                        </div>
                        <h6 class="card-title">Total Masculino</h6>
                        <p class="card-text" style="font-size: 10pt;">Total de alunos do genero masculino</p>
                        <div class="list-group">
                            <p class="list-group-item" style="font-size: 10pt;"> {{ $total - $countG }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
