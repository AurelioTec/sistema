@extends('base.app')
@section('titulo')
    -Usuario
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Lista de Usuários</h4>
            <a href="#Cadastro" onclick="limpar()" data-bs-toggle="modal" data-bs-target="#Cadastro"
                style="font-size: 28pt; color: #3498db">
                <i class="fa fa-circle-plus"></i>
            </a>
        </div>
        <hr>
        <table id="tabUsuario" class="display tabela" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($user as $use)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $use->name }}</td>
                        <td>{{ $use->email }}</td>
                        <td>{{ $use->tipo }}</td>
                        <td>
                            <a href="#Cadastro" data-bs-toggle="modal" onclick="editar({{ json_encode($use) }})"
                                class="btn text-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('usuario.apagar', $use->id) }}" class="btn text-danger"
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
    <div class="modal fade" id="Cadastro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Cadastrar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('usuario.cadastrar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo de Usuário</label>
                                <select name="tipo" id="tipo" class="form-control" required>
                                    <option value="" disabled selected>Selecione o tipo</option>
                                    <option value="Diretor">Diretor</option>
                                    <option value="Pedagogico">Pedagógico</option>
                                    <option value="Tecnico">Técnico</option>
                                </select>
                            </div>
                            <div class="modal-footer">
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
            $('#name').val(valor.name);
            $('#email').val(valor.email);
            $('#tipo').val(valor.tipo);
        }

        function limpar() {
            $('#id').val("");
            $('#name').val("");
            $('#email').val("");
            $('#tipo').val("");
        }
    </script>
    </main>
@endsection
