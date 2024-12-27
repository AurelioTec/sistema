<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Favio Aurelio, GuitHub: AurelioTec">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/blade/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#provincia').change(function() {
                var provinciaId = $(this).val();
                if (provinciaId) {
                    $.ajax({
                        url: 'aluno/municipios/' + provinciaId,
                        type: 'GET',
                        success: function(data) {
                            $('#municipio').empty().append(
                                '<option value="" disabled>Selecione um Município</option>'
                            );
                            $('#cidade').empty().append(
                                '<option value="" disabled>Selecione a cidade</option>'
                            );

                            $.each(data, function(key, municipio) {
                                $('#municipio').append('<option value="' + municipio
                                    .id + '">' + municipio.muninome + '</option>');
                                $('#cidade').append('<option value="' + municipio.id +
                                    '">' + municipio.muninome + '</option>');
                            });
                            $('#municipio').prop('disabled', false);
                            $('#cidade').prop('disabled', false);
                        }
                    });
                } else {
                    $('#municipio').empty().append('<option value="">Selecione um município</option>').prop(
                        'disabled', true);
                    $('#cidade').empty().append('<option value="">Selecione a cidade</option>').prop(
                        'disabled', true);
                }
            });


            // Evento para capturar o clique na âncora
            $('a[data-bs-toggle="modal"]').on('click', function() {
                var alunoId = $(this).data('id'); // Pega o ID armazenado no atributo data-id
                // Aqui você pode fazer uma requisição AJAX para buscar as informações no banco de dados
                $.ajax({
                    url: 'aluno/inscriao/' + alunoId,
                    alunoId, // Rota que irá buscar as informações do aluno (ajuste conforme sua rota)
                    method: 'GET',
                    success: function(response) {

                        if (response && response.id) {
                            // Preenchendo os campos do modal com os dados do aluno
                            $('#alunoId').val(response.id);
                            $('#Genero').text(response.genero);
                            $('#nomeAluno').text(response.nomealuno);
                            $('#nomeluno').val(response.nomealuno);
                            $('#dataNascimento').text(response.datanascimento);
                            var foto = response.foto ? '/img/upload/aluno/' + response.foto :
                                'default-foto.jpg';
                            $('.foto-aluno').attr('src', foto);
                        }
                    },
                    error: function() {

                    }
                });
            });


            // Função corrigida para carregar a turma
            function carregarTurma(classe, periodo) {
                if (classe && periodo) { // Usando "&&" para verificar ambas as condições
                    $.ajax({
                        url: 'aluno/turmas/' + classe + '/' + periodo,
                        type: 'GET',
                        success: function(data) {
                            // Limpando os selects antes de carregar
                            $('#turma').empty().append('<option value="" disabled>Turma</option>');
                            $.each(data, function(key, turma) {
                                $('#turma').append('<option value="' + turma.id + '">' + turma
                                    .descricao + '</option>');
                                $('#anoletivo').val(turma.anoletivo)
                            });
                        } // Fechando o parêntese corretamente
                    });
                }
            }

            // Ação quando o modal for exibido
            $('#Matricula').on('shown.bs.modal', function() {
                // Função chamada inicialmente quando o modal for exibido
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();

                // Chama a função com os valores iniciais
                carregarTurma(classe, periodo);

                // Evento de mudança no campo "classe"
                $('#classe').change(function() {
                    classe = $(this).val(); // Atualiza o valor de "classe"
                    carregarTurma(classe, periodo); // Chama a função com o novo valor de "classe"
                });

                // Evento de mudança no campo "periodo"
                $('#periodo').change(function() {
                    periodo = $(this).val(); // Atualiza o valor de "periodo"
                    carregarTurma(classe, periodo); // Chama a função com o novo valor de "periodo"
                });
            });

            // Função corrigida para carregar a turma
            function getTurma(classe, periodo) {
                if (classe && periodo) { // Usando "&&" para verificar ambas as condições
                    $.ajax({
                        url: 'relatorio/turma/' + classe + '/' + periodo,
                        type: 'GET',
                        success: function(data) {
                            // Limpando os selects antes de carregar
                            $('#turma').empty().append('<option value="" disabled>Turma</option>');
                            $.each(data, function(key, turma) {
                                $('#turma').append('<option value="' + turma.descricao + '">' +
                                    turma
                                    .descricao + '</option>');
                            });
                        } // Fechando o parêntese corretamente
                    });
                }
            }
            $('#getTurma').on('shown.bs.modal', function() {
                // Função chamada inicialmente quando o modal for exibido
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();
                // Chama a função com os valores iniciais
                getTurma(classe, periodo);

                // Evento de mudança no campo "classe"
                $('#classe').change(function() {
                    classe = $(this).val(); // Atualiza o valor de "classe"
                    getTurma(classe, periodo); // Chama a função com o novo valor de "classe"
                });

                // Evento de mudança no campo "periodo"
                $('#periodo').change(function() {
                    periodo = $(this).val(); // Atualiza o valor de "periodo"
                    getTurma(classe, periodo); // Chama a função com o novo valor de "periodo"
                });
            });
            $('#pesquisar').on('click', function(e) {
                e.preventDefault(); // Impede a submissão tradicional do formulário

                var classe = $('#classe').val();
                var periodo = $('#periodo').val();
                var turma = $('#turma').val();
                var anoletivo = $('#anolectivo').val();

            });
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/blade/logo.png') }}" height="30" width="30" alt="Logo"> SIGA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav">
                    @if (Auth::check() && $funcionario && $funcionario->foto)
                        <!-- Verifica se o usuário está logado e tem uma imagem de perfil -->
                        <a class="nav-link" href="#">
                            <img src="{{ asset('img/upload/funcio/' . $funcionario->foto) }}" height="30"
                                width="30" alt="Imagem do Usuário">
                        </a>
                    @else
                        <a class="nav-link " href="#">
                            <img src="{{ asset('img/blade/logo.png') }}" height="30" width="30" alt="Logo">
                        </a>
                    @endif
                    <a class="nav-link " href="{{ route('sair') }}">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid-expand-md m-0">
        <div class="row">
            <nav class="col-lg-2 col-md-3 col-sm-12 lateral">
                <ul class="nav flex-column">
                    @include('base.menu')
                </ul>
            </nav>
            <main class="col-lg-10 col-md-9 col-sm-12">
                @yield('conteudo')
            </main>
        </div>
    </div>

    @include('sweetalert::alert')

    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable.isDataTable('#tabConfigIni')) {
                $('.tabela').DataTable().destroy();
            }
            $('.tabela').DataTable({
                "pageLength": 5 // Define o número de registros por página
            });

        });
    </script>
</body>

</html>
