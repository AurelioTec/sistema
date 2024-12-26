@extends('base.app')
@section('titulo')
    -Turmas
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Lista de turmas</h4>
            <a href="#Cadastro" onclick="limpar()" data-bs-toggle="modal" data-bs-target="#Cadastro"
                style="font-size: 28pt; color: #3498db" title="Cadstrar turma">
                <i class="fa fa-circle-plus"></i>
            </a>
        </div>
        <hr>
        <table id="tabTurma" class="display tabela" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Classe </th>
                    <th>Codigo</th>
                    <th>Descrição</th>
                    <th>Periodo</th>
                    <th>Sala</th>
                    <th>Anolectivo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($turmas as $turma)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $turma->classe }}</td>
                        <td>{{ $turma->codigo }}</td>
                        <td>{{ $turma->descricao }}</td>
                        <td>{{ $turma->periodo }}</td>
                        <td>{{ $turma->sala }}</td>
                        <td>{{ $turma->anolectivo }}</td>
                        <td>
                            <a href="#Cadastro" data-bs-toggle="modal" onclick="editar({{ json_encode($turma) }})"
                                class="btn text-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('funcionario.apagar', $turma->id) }}" class="btn text-danger"
                                data-confirm-delete="true">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="Cadastro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Configurar Turma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form action="{{ route('turma.cadastrar') }}" class="row g-3" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="col-3">
                                <label for="classe" class="form-label">Classe</label>
                                <select id="classe" class="form-control" name="classe" required>
                                    <option value="7ª">7ª</option>
                                    <option value="8ª">8ª</option>
                                    <option value="9ª">9ª</option>
                                </select>
                            </div>

                            <div class="col-3">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="text" id="codigo" class="form-control" name="codigo" maxlength="5"
                                    required>
                            </div>

                            <div class="col-3">
                                <label for="descricao" class="form-label">Descrição:</label>
                                <input type="text" id="descricao" class="form-control" name="descricao" required>
                            </div>

                            <div class="col-3">
                                <label for="periodo" class="form-label">Período</label>
                                <select id="periodo" class="form-control" name="periodo" required>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="sala" class="form-label">Sala</label>
                                <select id="sala" class="form-control" name="sala" required>
                                    @foreach ($config as $conf)
                                        @for ($i = 1; $i <= $conf->salas; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="anolectivo" class="form-label">Ano Letivo</label>
                                <select id="anolectivo" class="form-control" name="anolectivo" required>
                                    @foreach ($config as $conf)
                                        <option value="{{ $conf->anoletivo }}">{{ $conf->anoletivo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
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
            $('#nome').val(valor.nome);
            $('#nagente').val(valor.nagente);
            $('#datanascimento').val(valor.datanascimento);
            $('#categoria').val(valor.categoria);
            $('#genero').val(valor.genero);
            $('#habilitacao').val(valor.habilitacao);
            $('#telf').val(valor.telf);
            $('#funcao').val(valor.funcao);
            $('#email').val(valor.user.email);
        }

        function limpar() {
            $('#nome').val("");
            $('#nagente').val("");
            $('#datanascimento').val("");
            $('#categoria').val("");
            $('#genero').val("");
            $('#habilitacao').val("");
            $('#telf').val("");
            $('#funcao').val("");
        }
    </script>
    </main>
@endsection
