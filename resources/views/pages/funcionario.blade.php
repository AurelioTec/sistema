@extends('base.app')
@section('titulo')
    -Funcionario
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Lista de funcionarios</h4>
            <a href="#Cadastro" onclick="limpar()" data-bs-toggle="modal" data-bs-target="#Cadastro"
                style="font-size: 28pt; color: #3498db">
                <i class="fa fa-circle-plus"></i>
            </a>
        </div>
        <hr>
        <table id="tabFuncionario" class="display tabela" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>foto</th>
                    <th>Nº agente</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Habilitação</th>
                    <th>Função</th>
                    <th>Telefone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($funcio as $func)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td><img src="{{ asset('img/upload/' . $func->foto) }}" alt="" style="width: 38px"></td>
                        <td>{{ $func->nagente }}</td>
                        <td>{{ $func->nome }}</td>
                        <td>{{ $func->categoria }}</td>
                        <td>{{ $func->habilitacao }}</td>
                        <td>{{ $func->funcao }}</td>
                        <td>{{ $func->telf }}</td>
                        <td>
                            <a href="#Cadastro" data-bs-toggle="modal" onclick="editar({{ json_encode($func) }})"
                                class="btn text-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('funcionario.apagar', $func->id) }}" class="btn text-danger"
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
                    <h5 class="modal-title" id="modalTitleId">Cadastrar funcionario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form action="{{ route('funcionario.cadastrar') }}" class="row g-3" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="col-6">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>

                            <div class="col-3">
                                <label for="datanascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" name="datanascimento" id="datanascimento"
                                    required>
                            </div>

                            <div class="col-3">
                                <label for="genero">Gênero</label>
                                <select name="genero" id="genero" class="form-control" required>
                                    <option value="" disabled selected>Selecione o gênero</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>

                            <div class="col-3">
                                <label for="telf">Telefone</label>
                                <input type="tel" class="form-control" name="telf" id="telf" required>
                            </div>

                            <div class="col-3">
                                <label for="habilitacao">Habilitação</label>
                                <select name="habilitacao" id="habilitacao" class="form-control" required>
                                    <option value="" disabled selected>Selecione a habilitação</option>
                                    <option value="Médio">Ensino Médio</option>
                                    <option value="Superior">Ensno Superior</option>
                                    <option value="Mestre">Mestrado</option>
                                    <option value="Doutor">Doutoramento</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="categoria">Categoria</label>
                                <input type="text" class="form-control" name="categoria" id="categoria" required>
                            </div>
                            <div class="col-3">
                                <label for="nagente">Nº de Agente</label>
                                <input type="number" class="form-control" name="nagente" id="nagente" maxlength="8"
                                    minlength="8">
                            </div>

                            <div class="col-4">
                                <label for="funcao">Funcão</label>
                                <input type="text" class="form-control" name="funcao" id="funcao" required>
                            </div>

                            <div class="col-5">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                            <div class="col-12">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" name="foto" id="foto"
                                    accept="image/*">
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
