@extends('base.app')
@section('titulo')
    -Home
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Perfil do utilizador</h2>

            <div class="row extra_margin">

                <!-- First column (smaller of the two). Will appear on the left on desktop and on the top on mobile. -->
                <div class="col-md-4 col-sm-12 col-xs-12 text-center">

                    <!-- Displaying user's photo or a placeholder if not available -->
                    <img src="{{ $funcionario->foto ? asset('img/upload/funcio/' . $funcionario->foto) : 'http://via.placeholder.com/300x250' }}"
                        class="img-fluid rounded-circle" alt="Foto do Funcionario" />

                    <!-- Displaying the user's name -->
                    <h2>{{ $funcionario->nome }}</h2>

                    <!-- Displaying social buttons (if needed) -->
                    <p>
                        <a class="btn btn-primary btn-sm" role="button" href="#Update" title="Alterar senha"
                            data-bs-toggle="modal" data-id="{{ $user->id }}">Alterar senha</a>
                        <a class="btn btn-primary btn-sm"href="#" role="button">Editar dados</a>
                        <a class="btn btn-primary btn-sm" role="button" href="#Updatefoto" title="Alterar Foto"
                            data-bs-toggle="modal" data-id="{{ $user->id }}">Alterar foto</a>
                    </p>

                </div> <!-- End Col 1 -->

                <!-- Second column - for small and extra-small screens, will use whatever # cols is available -->
                <div class="col-md-8 col-sm-12 col-xs-12">

                    <!-- Displaying the user type and email -->
                    <div class="lead">
                        <h4>Tipo de Usuário: <strong>{{ $user->tipo }}</strong></h4>
                        <h4>Email: <strong>{{ $user->email }}</strong></h4>
                    </div>

                    <!-- Horizontal rule to add some spacing between the "lead" and body text -->
                    <hr />

                    <!-- Displaying employee details -->
                    <h4>Informações do Funcionário</h4>
                    <ul>
                        <li><strong>Número Agente:</strong> {{ $funcionario->nagente }}</li>
                        <li><strong>Data de Nascimento:</strong>
                            {{ \Carbon\Carbon::parse($funcionario->datanascimento)->format('d/m/Y') }}</li>
                        <li><strong>Gênero:</strong> {{ $funcionario->genero == 'M' ? 'Masculino' : 'Feminino' }}</li>
                        <li><strong>Telefone:</strong> {{ $funcionario->telf }}</li>
                        <li><strong>Habilitação:</strong> {{ $funcionario->habilitacao }}</li>
                        <li><strong>Categoria:</strong> {{ $funcionario->categoria }}</li>
                        <li><strong>Função:</strong> {{ $funcionario->funcao }}</li>
                    </ul>

                    <!-- Optionally, you can add more content about the user/employee here -->
                    <p>Adicione mais detalhes sobre o funcionário ou algum texto adicional aqui.</p>

                </div> <!-- End Col 2 -->
            </div> <!-- End Row -->
        </div>
    </div>

    <!-- Modal alterar senha -->
    <div class="modal fade " id="Update" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Alterar senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form action="{{ route('usuario.update') }}" class="row g-3" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">

                            <div class="col-12">
                                <label for="nome">Nova Senha</label>
                                <input type="text" minlength="6" class="form-control" name="password" id="password"
                                    required>
                            </div>
                            <div class="col-12">
                                <label for="nome">Confirmar Senha</label>
                                <input type="text" minlength="6" class="form-control" name="confirmed" id="confirmed"
                                    required>
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

    <!-- Modal alterar foto -->
    <div class="modal fade " id="Updatefoto" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Alterar Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form action="{{ route('usuario.updatefoto') }}" method="POST" enctype="multipart/form-data"class="row g-3">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">

                            <div class="col-12">
                                <label for="foto">Selecione a Nova Foto:</label>
                                <input type="file" name="foto" class="form-control" id="foto" required>
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
@endsection
