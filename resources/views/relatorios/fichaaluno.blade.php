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
            <div class="col-md-6">
                {{ dd($aluno) }}
                <label><strong>Idade Provável até Maio:</strong><span
                        class="text-decoration-underline"></span>anos</label>
            </div>
            <div class="col-md-6">
                <strong>SEXO:</strong>
                <label class="form-check-label me-3">M<input type="checkbox" class="ms-1"></label>
                <label class="form-check-label">F<input type="checkbox" class="ms-1"></label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label><strong>Processo Individual Nº:</strong><span class="text-decoration-underline"></span></label>
            </div>
            <div class="col-md-6">
                <label><strong>Nº de Matrícula:</strong><span class="text-decoration-underline"></span></label>
            </div>
        </div>

        <p class="section-title">Dados do Aluno</p>
        <p>Matrícula na<span class="text-decoration-underline"></span> classe pela <span
                class="text-decoration-underline"></span> ª vez | Ano Lectivo de 20<span
                class="text-decoration-underline"></span>| Inscrição nº<span class="text-decoration-underline"></span>
        </p>
        <p>Nome:<span class="text-decoration-underline"></span></p>
        <p>Data de Nascimento:<span class="text-decoration-underline"></span>| BI nº<span
                class="text-decoration-underline"></span>| Emitido aos <span class="text-decoration-underline"></span>
        </p>
        <p>Arquivo de Identificação de<span class="text-decoration-underline"></span>| Documento Militar nº<span
                class="text-decoration-underline"></span></p>
        <p>Filho de<span class="text-decoration-underline"></span>e de <span class="text-decoration-underline"></span>
        </p>
        <p>Morada do aluno:<span class="text-decoration-underline"></span>Rua: <span
                class="text-decoration-underline"></span></p>

        <p class="section-title">Informações Adicionais</p>
        <p>Encarregado de Educação:<span class="text-decoration-underline"></span>| Telf. nº<span
                class="text-decoration-underline"></span></p>
        <p>Língua Estrangeira de Opção: <span class="text-decoration-underline"></span>| Área de Conhecimento: <span
                class="text-decoration-underline"></span></p>
        <p>Data: <span class="text-decoration-underline"></span> de <span class="text-decoration-underline"></span>de
            <span class="text-decoration-underline"></span>
        </p>

        <p class="section-title">Autorização</p>
        <p>
            AUTORIZO A MATRÍCULA <span class="text-decoration-underline"></span>| ALUNO OU ENCARREGADO DE EDUCAÇÃO<span
                class="text-decoration-underline"></span><br>
            O DIRECTOR: <span class="text-decoration-underline"></span> | O FUNCIONÁRIO: <span
                class="text-decoration-underline"></span>
        </p>

        <p>Matrícula Efetuada em <span class="text-decoration-underline"></span></p>
        <hr>
        <p>
            Nome: ______________________________ | Data de Inscrição: ___/___/______ | INSCRIÇÃO Nº _________<br>
            Talão de Matrícula na _______ Classe
        </p>

        <p class="text-center">CONSERVAR ESTE TALÃO ATÉ À ABERTURA DAS AULAS</p>
        <hr>
    </div>
    <script>
        // Função para acionar a impressão ao carregar a página
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
