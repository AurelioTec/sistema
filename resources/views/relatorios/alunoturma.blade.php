<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/rel.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/blade/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <title>Relatorio-Aluno</title>
</head>

<body>
    <div class="base">
        <div class="titulo">
            <img src="{{ asset('img/blade/insignia.png') }}" alt="">
            <h4>Republica de Angola</h4>
            <h4>Administração Municipal de Benguela</h4>
            <h4>Direção Municipal da Educação de Benguela</h4>
            <h4>Complexo Escolar BG Nº 1237</h4>
        </div>
        <div class="card">
            <div class="card-header text-center">
                <h4>Relação Nominal de Aluno</h4>
            </div>
            <div class=" text-center d-inline-flex justify-content-center align-items-center gap-4">
                <h4>Classe:{{ $header->turma->classe }}</h4>
                <h4>Turma:{{ $header->turma->descricao }}</h4>
                <h4>Periodo:{{ $header->turma->periodo }}</h4>
                <h4>Sala:{{ $header->turma->sala }}</h4>
                <h4>Ano Lectivo:{{ $header->turma->anolectivo }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ord.</th>
                            <th>Nº Matricula</th>
                            <th>Nome Completo</th>
                            <th>Idade</th>
                            <th>Genero</th>
                            <th>Obs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            //dd($header->turma->datanascimento);
                        @endphp

                        @foreach ($alunos as $aluno)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $aluno->numatricula }}</td>
                                <td>{{ $aluno->inscricao->nomealuno }}</td>
                                <td>{{ \Carbon\Carbon::parse($aluno->inscricao->datanascimento)->age }}</td>
                                <td>{{ $aluno->inscricao->genero }}</td>
                                <td>{{ 'Aluno ' . $aluno->tipomatricula }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Área de Assinaturas -->
                <div class="assinaturas mt-5">
                    <div class="row">
                        <div class="col-6 text-center">
                            <p style="font-size: 12px; border-top: 1px solid #000; padding-top: 20px;">Assinatura do
                                Diretor da Escola</p>
                        </div>
                        <div class="col-6 text-center">
                            <p style="font-size: 12px; border-top: 1px solid #000; padding-top: 20px;">Assinatura do
                                Pedagógico</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rodapé Fixo -->
        <div class="footer fixed-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-left">
                        <p style="font-size: 9pt; text-align: left; margin-left: 2px;">Fonte de dados SIGA aos
                            {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-6 text-right">
                        <p style="font-size: 9pt; text-align: right; margin-right: 2px;">Utilizador:
                            {{ auth()->user()->name }}</p> <!-- Nome do utilizador logado -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Função para acionar a impressão ao carregar a página
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
