<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/ficha.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/blade/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <title>Ficha de Matricula</title>
</head>

<body>
    <div class="a4-container">
        <div class="header">
            <img src="{{ asset('img/blade/insignia.png') }}" alt="">
            <h5>REPÚBLICA DE ANGOLA</h5>
            <h6>ADMINISTRAÇÃO MUNICIPAL DE BENGUELA</h6>
            <h6>DIREÇÃO MUNICIPAL DA EDUCAÇÃO DE BENGUELA</h6>
            <h6>COMPLEXO ESCOLAR BG Nº 1237</h6>
            <h5>FICHA DE MATRÍCULA</h5>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-6">
                <label><strong>Idade Provável até Agosto: </strong><span
                        class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->inscricao->datanascimento)->age }}</span>anos</label>
            </div>
            <div class="col-md-6 col-sm-6">
                <strong class="text-center">GENERO:</strong>
                @if ($aluno->inscricao->genero == 'M')
                    <label class="form-check-label me-3">M<input type="checkbox" checked disabled
                            class="ms-1"></label>
                    <label class="form-check-label">F<input type="checkbox" disabled class="ms-1"></label>
                @else
                    <label class="form-check-label me-3">M<input type="checkbox" disabled class="ms-1"></label>
                    <label class="form-check-label">F<input type="checkbox" checked disabled class="ms-1"></label>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 col-sm-6">
                <label><strong>Processo Individual Nº:</strong><span class="text-decoration-underline"></span></label>
            </div>
            <div class="col-md-6 col-sm-6">
                <label><strong>Nº de Matrícula: </strong><span
                        class="text-decoration-underline">{{ $aluno->numatricula }}</span></label>
            </div>
        </div>

        <p class="section-title text-center fs-5 mb-0">Dados do Aluno</p>
        <hr>
        <p class="mt-0">Matrícula na <span class="text-decoration-underline">{{ $aluno->turma->classe }}</span> classe
            pela
            @if ($aluno->tipomatricula == 'Novo')
                <span class="text-decoration-underline">1ª vez </span>
            @else
                <span class="text-decoration-underline">2ª vez </span>
            @endif | Ano Lectivo de <span
                class="text-decoration-underline">{{ $aluno->turma->anolectivo }}</span>| Inscrição
            nº <span class="text-decoration-underline"></span>
        </p>
        <p>Nome: <span class="text-decoration-underline fw-bold fs-6">{{ $aluno->inscricao->nomealuno }}</span></p>
        <p>Data de Nascimento: <span
                class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->datanascimento)->format('d/m/Y') }}</span>|
            {{ $aluno->inscricao->doctipo }}
            nº <span class="text-decoration-underline">{{ $aluno->inscricao->docnumero }}</span>| Emitido aos <span
                class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->inscricao->dataemissao)->format('d/m/Y') }}</span>
        </p>
        <p>Arquivo de Identificação de <span class="text-decoration-underline">Benguela</span>| Documento Militar
            nº<span class="text-decoration-underline"></span></p>
        <p>Filho de <span class="text-decoration-underline">{{ $aluno->inscricao->nomepai }}</span>e de <span
                class="text-decoration-underline">{{ $aluno->inscricao->nomemae }}</span>
        </p>
        <p>Morada do aluno: <span class="text-decoration-underline">{{ $aluno->inscricao->bairro }}</span> Rua:
            <span class="text-decoration-underline">{{ $aluno->inscricao->rua }}</span>
        </p>
        <hr class="mb-0">

        <p class="section-title text-center fs-5 mt-0 mb-0">Informações Adicionais</p>
        <hr>
        <p>Turma: <span class="text-decoration-underline">{{ $aluno->turma->descricao }}</span> | Sala: <span
                class="text-decoration-underline">{{ $aluno->turma->sala }}</span>
            | Periodo: <span class="text-decoration-underline">{{ $aluno->turma->periodo }}</span> Lígua Estrangeira de
            Opção: <span class="text-decoration-underline">{{ $aluno->lestrangeira }}</span>
            |Ano Lectivo: <span class="text-decoration-underline">{{ $aluno->turma->anolectivo }}</span></p>
        <p>Encarregado de Educação: <span class="text-decoration-underline">{{ $aluno->encarregado }}</span>| Telf.
            nº <span class="text-decoration-underline">{{ $aluno->telfencarregado }}</span></p>
        <p classe="mb-0">Data: <span
                class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->datamatricula)->format('d') }}</span>
            de <span
                class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->datamatricula)->format('m') }}</span>
            de
            <span
                class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->datamatricula)->format('Y') }}</span>
        </p>
        <hr class="mb-0 mt-0">
        <div style="text-align: center; margin-top: 2px; padding-bottom: 2px;">
            <p
                style="display: inline-block; width: 70%; margin-top: 0 auto; border-bottom: 1px solid black; padding-bottom: 30px; padding-top: 2px;">
                ALUNO OU ENCARREGADO DE EDUCAÇÃO
            </p>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 30px;">
            <div style="width: 30%; text-align: center; border-top: 1px solid black; margin-top: 10px;">
                O DIRECTOR:
            </div>
            <div style="width: 30%; text-align: center; border-top: 1px solid black;">
                O FUNCIONÁRIO:
            </div>
        </div>
        <p class="text-center pb-0">Matrícula Efetuada em {{ $aluno->inscricao->municipios->muninome }}, @if (\Carbon\Carbon::parse($aluno->datamatricula)->format('d') == 1)
                a,<span
                    class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->datamatricula)->format('d') }}</span>
            @else
                aos, <span
                    class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->datamatricula)->format('d') }}</span>
            @endif
            de <span
                class="text-decoration-underline">{{ ucfirst(\Carbon\Carbon::parse($aluno->datamatricula)->locale('pt')->translatedFormat('F')) }}</span>
            de <span
                class="text-decoration-underline">{{ \Carbon\Carbon::parse($aluno->datamatricula)->format('Y') }}</span>
        </p>
        <hr class="pt-0">
        <p style="font-size: 11pt" class="pt-0 mt-0 text-center">
            Nome: {{ $aluno->inscricao->nomealuno }} | Data da matricula:
            {{ \Carbon\Carbon::parse($aluno->datamatricula)->format('d/m/Y') }}| Matricula Nº
            {{ $aluno->numatricula }}<br>
            Talão de Matrícula na {{ $aluno->turma->classe }} Classe, Turma: {{ $aluno->turma->descricao }}, Sala:
            {{ $aluno->turma->sala }}, Periodo: {{ $aluno->turma->periodo }}, Ano lectivo:
            {{ $aluno->turma->anolectivo }}
        </p>
        <hr class="pb-0 mb-0">
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px">
            <h6 class="text-left " style="font-size: 8pt">Fonte de Dados SIGA
            </h6>
            <h6 class="text-center" style="font-size: 8pt">CONSERVAR ESTE TALÃO ATÉ À ABERTURA DAS AULAS</h6>
            <h6 class="text-right" style="font-size: 8pt"><span class="text-right">Utilizador:
                    {{ Auth::user()->name }}</span></h6>
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
