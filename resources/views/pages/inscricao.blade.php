@extends('base.app')
@section('titulo')
    -Inscrição
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Alunos inscritos</h4>
            <a href="#Cadastro" onclick="limpar()" data-bs-toggle="modal" data-bs-target="#Cadastro"
                style="font-size: 28pt; color: #3498db">
                <i class="fa fa-circle-plus"></i>
            </a>
        </div>
        <hr>
        <table id="tabInscricao" class="display tabela" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>foto</th>
                    <th>Nome</th>
                    <th>Genero</th>
                    <th>Data nasc.</th>
                    <th>Bairro</th>
                    <th>Telefone</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @if ($alunos->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">Nenhum registro encontrado</td>
                    </tr>
                @else
                    @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img src="{{ asset('img/upload/aluno/' . $aluno->foto) }}" alt="foto"
                                    style="width: 38px">
                            </td>
                            <td>{{ $aluno->nomealuno }}</td>
                            <td>{{ $aluno->genero }}</td>
                            <td>{{ \Carbon\Carbon::parse($aluno->datanascimento)->format('d/m/Y') }}</td>
                            <td>{{ $aluno->bairro }}</td>
                            <td>{{ $aluno->telf }}</td>
                            <td>{{ $aluno->estado }}</td>
                            <td>
                                <a href="#Matricula" class="btn text-primary" title="Matricular aluno"data-bs-toggle="modal"
                                    data-id="{{ $aluno->id }}">
                                    <i class="fa fa-user-graduate"></i>
                                </a>
                                <a href="#Cadastro" title="Editar dados do aluno" data-bs-toggle="modal"
                                    onclick="editar({{ json_encode($aluno) }})" class="btn text-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('funcionario.apagar', $aluno->id) }}" class="btn text-danger"
                                    data-confirm-delete="true" title="Remover aluno">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal Inscrição -->
    <div class="modal fade " id="Cadastro" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen tela" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Cadastrar aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form action="{{ route('aluno.cadastrar') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf
                            <input type="hidden" name="idinscricao" id="ididinscricao">
                            <div class="col-md-5">
                                <label for="nomealuno" class="form-label">Nome do Aluno</label>
                                <input type="text" class="form-control" id="nomealuno" name="nomealuno" maxlength="120"
                                    required>
                            </div>
                            <div class="col-md-2">
                                <label for="datanascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="datanascimento" name="datanascimento"
                                    required>
                            </div>
                            <div class="col-md-2">
                                <label for="genero" class="form-label">Gênero</label>
                                <select class="form-select" id="genero" name="genero" required>
                                    <option value="" disabled>Selecione o genero</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="provincia" class="form-label">Provincia</label>
                                <select class="form-select" id="provincia" name="provincia" required>
                                    <option value="" disabled>Selecione a provincia</option>
                                    @foreach ($provincias as $provincia)
                                        <option value="{{ $provincia->id }}">{{ $provincia->pronome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="municipio" class="form-label">Município</label>
                                <select class="form-select" id="municipio" name="municipio" required>
                                    <option value="" disabled>Selecione um município</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="doctipo" class="form-label">Tipo de Documento</label>
                                <select class="form-select" id="doctipo" name="doctipo" required>
                                    <option value="" disabled>Selecione o documento</option>
                                    <option value="BI">Bilhete de Identidade</option>
                                    <option value="Cedula">Cédula</option>
                                    <option value="Assento">Assento</option>
                                    <option value="Passaporte">Passaporte</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="docnumero" class="form-label">Número do Documento</label>
                                <input type="text" class="form-control" id="docnumero" name="docnumero"
                                    maxlength="14" required>
                            </div>

                            <div class="col-md-3">
                                <label for="dataemissao" class="form-label">Data de Emissão</label>
                                <input type="date" class="form-control" id="dataemissao" name="dataemissao" required>
                            </div>

                            <div class="col-md-4">
                                <label for="nomepai" class="form-label">Nome do Pai</label>
                                <input type="text" class="form-control" id="nomepai" name="nomepai"
                                    maxlength="120">
                            </div>

                            <div class="col-md-4">
                                <label for="nomemae" class="form-label">Nome da Mãe</label>
                                <input type="text" class="form-control" id="nomemae" name="nomemae"
                                    maxlength="120">
                            </div>

                            <div class="col-md-3">
                                <label for="municipio" class="form-label">Morada/Cidade</label>
                                <select class="form-select" id="cidade" name="cidade" required>
                                    <option value="" disabled>Selecione a cidade</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro"
                                    maxlength="70">
                            </div>

                            <div class="col-md-3">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" class="form-control" id="rua" name="rua"
                                    maxlength="120">
                            </div>

                            <div class="col-md-3">
                                <label for="telf" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telf" name="telf"
                                    maxlength="15">
                            </div>

                            <div class="col-md-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto"
                                    accept="image/*">
                            </div>

                            <div class="col-md-12">
                                <label for="obs" class="form-label">Observações</label>
                                <textarea class="form-control" id="obs" name="obs" rows="1" maxlength="50"></textarea>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Matricula -->
    <div class="modal fade " id="Matricula" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg tela" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Matricular aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <div class="aluno-perfil d-flex align-items-center mb-4 p-3 border rounded">
                            <img src="" alt="Foto do Aluno" class="foto-aluno rounded-circle me-3"
                                width="100" height="100">
                            <div>
                                <h5 class="mb-1"><strong>Nome:</strong> <span id="nomeAluno"></span></h5>
                                <p class="mb-0"><strong>Gênero:</strong> <span id="Genero"></span></p>
                                <p class="mb-0"><strong>Data de Nascimento:</strong> <span id="dataNascimento"></span>
                                </p>

                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('aluno.matricular') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="alunoId" id="alunoId">
                            <input type="hidden" name="nomeAluno" id="nomeluno" >
                            <input type="hidden" name="anoletivo" id="anoletivo" >
                            <div class="col-3">
                                <label for="classe" class="form-label">Classe</label>
                                <select id="classe" class="form-control" name="classe" required>
                                    <option value="7ª">7ª</option>
                                    <option value="8ª">8ª</option>
                                    <option value="9ª">9ª</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="periodo" class="form-label">Período</label>
                                <select id="periodo" class="form-control" name="periodo" required>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="turma" class="form-label">Turma</label>
                                <select class="form-select" id="turma" name="turma" required>
                                </select>
                            </div>

                            <div class="col-3">
                                <label for="lestrangeira" class="form-label">L.Estrangeira</label>
                                <select class="form-select" id="lestrangeira" name="lestrangeira" required>
                                    <option value="Inglês">Inglês</option>
                                    <option value="Francês">Francês</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="encarregado" class="form-label">Encarregado</label>
                                <input type="text" class="form-control" id="encarregado" name="encarregado"
                                    maxlength="120">
                            </div>

                            <div class="col-6">
                                <label for="telfencarregado" class="form-label">Telf.Encarregado</label>
                                <input type="tel" class="form-control" id="telfencarregado" name="telfencarregado"
                                    maxlength="15">
                            </div>

                            <div class="col-md-8">
                                <label for="anexo" class="form-label">Anexar(*certificado,*termos, boletim de nota) em
                                    PDF max 2MB</label>
                                <input type="file" class="form-control" id="anexo" name="anexo">
                            </div>

                            <div class="col-md-4">
                                <label for="tipomatricula" class="form-label">Tipo de Matrícula</label>
                                <select class="form-select" id="tipomatricula" name="tipomatricula" required>
                                    <option value="Novo">Novo</option>
                                    <option value="Continuante">Continuante</option>
                                </select>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Matricular</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript" async>
        function editar(valor) {
            $('#nomealuno').val(valor.nomealuno);
            $('#municipio').val(valor.municipio);
            $('#datanascimento').val(valor.datanascimento);
            $('#genero').val(valor.genero);
            $('#doctipo').val(valor.doctipo);
            $('#docnumero').val(valor.docnumero);
            $('#dataemissao').val(valor.dataemissao);
            $('#nomepai').val(valor.nomepai);
            $('#nomemae').val(valor.nomemae);
            $('#cidade').val(valor.morada);
            $('#bairro').val(valor.bairro);
            $('#rua').val(valor.rua);
            $('#telf').val(valor.telf);
            $('#foto').val(valor.foto);
            $('#obs').val(valor.obs);
        }

        function limpar() {
            $('#nomealuno').val("");
            $('#datanascimento').val("");
            $('#docnumero').val("");
            $('#dataemissao').val("");
            $('#nomepai').val("");
            $('#nomemae').val("");
            $('#bairro').val("");
            $('#rua').val("");
            $('#telf').val("");
            $('#obs').val("");
            $('#foto').val("");
        }
    </script>
    </main>
@endsection
