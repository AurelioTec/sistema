@extends('base.app')
@section('titulo')
    -ConfigIni
@endsection
@section('conteudo')
    <div class="container  bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Configurar ano lectivo</h4>
            <a href="#Cadastro" onclick="limpar()" data-bs-toggle="modal" data-bs-target="#Cadastro"
                class="btn btn-info text-dark" title="Configurar novo ano Letivo">
                <i class="fa fa-circle-plus"></i>
                Adicionar
            </a>
        </div>
        <hr>
        <table id="tabConfigIni" class=" tabela display pt-2 " style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Escola</th>
                    <th>Tipo</th>
                    <th>Salas</th>
                    <th>Ano Letivo</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tabelaDados">

                @php
                    $i = 1;
                @endphp
                @foreach ($config as $conf)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $conf->escola }}</td>
                        <td>{{ $conf->tipo }}</td>
                        <td>{{ $conf->salas }}</td>
                        <td>{{ $conf->anoletivo }}</td>
                        <td>{{ $conf->estado }}</td>
                        <td>
                            @if ($conf->estado == 'Aberto')
                                <a href="#Cadastro" data-bs-toggle="modal" onclick="editar({{ $conf }})"
                                    class="btn text-success" title="Editar configurações">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('config.encerrar', Crypt::encrypt($conf->id)) }}" class="btn text-danger"
                                    data-confirm-delete="true" title="Encerrar ano lectivo">
                                    <i class="fa fa-sign-out"></i>
                                </a>
                            @endif
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="Cadastro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Configuar novo ano lectivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="POST" action="{{ route('config.guardar') }}" class="row g-3">
                            @csrf
                            <!-- Primeira linha -->
                            <input type="hidden" name="id" id="id">
                            <div class="col-5">
                                <label for="escola">Nome da escola</label>
                                <input type="text" class="form-control" name="escola" id="escola" required>
                            </div>
                            <div class="col-2">
                                <label for="salas">Total de salas</label>
                                <input type="number" min="5" name="salas" class="form-control" id="salas"
                                    required>
                            </div>
                            <div class="col-2">
                                <label for="anoLetivo">Ano Letivo</label>
                                <input type="number" class="form-control" name="anoletivo" min="{{ now()->year }}"
                                    max="2100" id="anoLetivo" required>
                            </div>
                            <div class="col-3">
                                <label for="tipo">Tipo</label>
                                <select class="form-select" name="tipo" id="tipo" required>
                                    <option selected>Escolher Tipo...</option>
                                    <option value="Colegio">Colégio</option>
                                    <option value="Complexo">Complexo</option>
                                    <option value="Escola primaria">Escola Primária</option>
                                </select>
                            </div>
                            <!-- Segunda linha -->
                            <div class="col-4">
                                <label for="director">Nome do director</label>
                                <input type="text" name="diretor" class="form-control" id="diretor" required>
                            </div>
                            <div class="col-4">
                                <label for="pedagogico">Nome do pedagógico</label>
                                <input type="text" name="pedagogico" class="form-control" id="pedagogico" required>
                            </div>
                            <div class="col-4">
                                <label for="administrativo">Nome do administrativo</label>
                                <input type="text" name="administrativo" class="form-control" id="administrativo"
                                    required>
                            </div>

                            <!-- Linha do botão -->
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="btn btn-primary "
                                    style="background: #3498db">Guardar</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editar(valor) {
            $('#id').val(valor.id);
            $('#escola').val(valor.escola);
            $('#salas').val(valor.salas);
            $('#anoLetivo').val(valor.anoletivo);
            $('#tipo').val(valor.tipo);
            $('#diretor').val(valor.director);
            $('#pedagogico').val(valor.pedagogico);
            $('#administrativo').val(valor.administrativo);
            $('#submit').text('Salvar');
            $('#modalTitleId').text("Editar ano lectivo");
        }

        function limpar() {
            $('#id').val("");
            $('#escola').val("");
            $('#salas').val("");
            $('#anoLetivo').val("");
            $('#tipo').val("");
            $('#diretor').val("");
            $('#pedagogico').val("");
            $('#administrativo').val("");
        }
    </script>
@endsection
