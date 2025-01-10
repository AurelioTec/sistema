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
    <title>Relatório de Usuários</title>
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
                <h4>Lsita de Utilizadores</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ord.</th>
                            <th>Nome Completo</th>
                            <th>E-mail</th>
                            <th>Cargo</th>
                            <th>Data de Criação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp

                        @foreach ($user as $usuario)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->tipo }}</td>
                                <td>{{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y') }}</td>
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
