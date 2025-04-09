@extends('base.app')
@section('titulo')
- Perfil do Aluno
@endsection
@section('conteudo')
<div class="container bg-light">
    <div class="container px-4 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom">Perfil do Aluno</h2>

        <div class="row extra_margin">
            <div class="col-md-4 col-sm-12 col-xs-12 text-center p-1">
                <img src="{{ $aluno->foto ? asset('img/upload/aluno/' . $aluno->foto) : 'http://via.placeholder.com/300x250' }}"
                    class="img-fluid rounded-circle" alt="Foto do Aluno" />
                <h2>{{ $aluno->nomealuno }}</h2>
                <p>
                    <a class="btn btn-primary btn-sm" role="button" href="#Update" title="Lançar notas"
                        data-bs-toggle="modal" data-id="">Lançar notas</a>
                    <a class="btn btn-primary btn-sm" href="#" role="button">Editar dados</a>
                    <a class="btn btn-primary btn-sm" role="button" href="#Updatefoto" title="Alterar Foto"
                        data-bs-toggle="modal" data-id="">Alterar foto</a>
                </p>
            </div>

            <div class="col-md-5 col-sm-12 col-xs-12 p-1">
                <div style=" border-left: 2px solid #000; height: 100%; margin: 0 10px">
                    <h4 class="ps-3">Informações do Aluno</h4>
                    <ul class="list-unstyled ps-3">
                        <li><strong>Número da Matrícula:</strong> {{ $matricula->numatricula }}</li>
                        <li><strong>Data da Matrícula:</strong>
                            {{ \Carbon\Carbon::parse($matricula->datamatricula)->format('d/m/Y') }}
                        </li>
                        <li><strong>Língua Estrangeira:</strong> {{ $matricula->lestrangeira ?? 'Não especificada' }}
                        </li>
                        <li><strong>Estado da Matrícula:</strong> {{ $matricula->estado }}</li>
                        <li><strong>Tipo de Matrícula:</strong> {{ $matricula->tipomatricula }}</li>
                        <li><strong>Encarregado:</strong> {{ $matricula->encarregado ?? 'Não especificado' }}</li>
                        <li><strong>Telefone do Encarregado:</strong>
                            {{ $matricula->telfencarregado ?? 'Não especificado' }}
                        </li>
                    </ul>

                    <h4 class="ps-3">Informações Pessoais</h4>
                    <ul class="list-unstyled ps-3">
                        <li><strong>Nome do Pai:</strong> {{ $aluno->nomepai ?? 'Não especificado' }}</li>
                        <li><strong>Nome da Mãe:</strong> {{ $aluno->nomemae ?? 'Não especificado' }}</li>
                        <li><strong>Data de Nascimento:</strong>
                            {{ \Carbon\Carbon::parse($aluno->datanascimento)->format('d/m/Y') }}
                        </li>
                        <li><strong>Gênero:</strong> {{ $aluno->genero == 'M' ? 'Masculino' : 'Feminino' }}</li>
                        <li><strong>Telefone:</strong> {{ $aluno->telf ?? 'Não especificado' }}</li>
                        <li><strong>Endereço:</strong> {{ $aluno->municipios->muninome ?? 'Não especificado' }} /
                            {{ $aluno->bairro ?? 'Não especificado' }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12 p-1">
                <div style=" border-left: 2px solid #000; height: 100%; margin: 0 10px">
                    <ul class="list-unstyled list-group ps-3 m-1">
                        <li class=" list-group-item badge bg-warning mb-1"><a href="{{route('matricula.suspender', Crypt::encrypt($matricula->id))}}"
                                class=" text-dark text-decoration-none">Suspender</a></li>
                        <li class="list-group-item badge bg-secondary mb-1"><a href="#"
                                class=" text-light text-decoration-none">Inativar</a></li>
                        <li class="list-group-item badge bg-danger mb-1"><a href="#"
                                class="text-light text-decoration-none">Cancelar</a></li>
                        <li class="list-group-item badge bg-info mb-1"><a href="#"
                                class="text-dark text-dark text-decoration-none">Transferir</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" async>
    $(function() {
        $('#toggle-two').bootstrapToggle({
            on: 'Enabled',
            off: 'Disabled'
        });
    })
</script>
@endsection