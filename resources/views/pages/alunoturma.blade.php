@extends('base.app')
@section('titulo')
-Maticula
@endsection
@section('conteudo')
<div class="container bg-light">
    <div class="card-header d-flex justify-content-between align-items-center pt-4 m-0">
        <div class=" text-center d-inline-flex justify-content-center align-items-center gap-4">
            <h5>Classe:{{ $header->turma->classe }}</h5>
            <h5>Turma:{{ $header->turma->descricao }}</h5>
            <h5>Periodo:{{ $header->turma->periodo }}</h5>
            <h5>Sala:{{ $header->turma->sala }}</h5>
            <h5>Ano Lectivo:{{ $header->turma->anolectivo }}</h5>
        </div>

        <a href="##" 
            class="btn btn-primary text-light" title="imprimir lista de aluno por turma">
            <i class="fa fa-print"></i>
        </a>
 
        <a href="#getAlunoTurma" data-bs-toggle="modal" data-bs-target="#getAlunoTurma"
            class="btn btn-warning text-light" title="Pesquisar alunos por turma">
            <i class="fa fa-search"></i>
        </a>
    </div>
    <hr class="mb-0">
    <table id="tabAlunoTurma" class="display tabela pt-2" style=" width:100%;">
        <thead>
            <tr>
                <th>Ord.</th>
                <th>Nº Matricula</th>
                <th>Nome Completo</th>
                <th>Idade</th>
                <th>Genero</th>
                <th>Obs</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            //dd($header->turma->datanascimento);
            @endphp

            @foreach ($alunos as $aluno)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $aluno->numatricula }}</td>
                <td>{{ $aluno->inscricao->nomealuno }}</td>
                <td>{{ \Carbon\Carbon::parse($aluno->inscricao->datanascimento)->age }}</td>
                <td>{{ $aluno->inscricao->genero }}</td>
                <td>{{ 'Aluno ' . $aluno->tipomatricula }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal Pesquisar aluno turma -->
<div class="modal fade " id="getAlunoTurma" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg tela" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header ">
                <h5 class="modal-title" id="modalTitleId">Buscar aluno/turma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="container-fluid">
                    <form action="{{ route('relatorio.turmaluno') }}" id="FormAlunoTurma" method="GET"
                        enctype="multipart/form-data" class="row g-3">
                        @csrf
                        <input type="hidden" name="sala" id="sala">
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
                            <select class="form-select" id="turmas" name="turma" required>
                            </select>
                        </div>

                        <div class="col-3">
                            <label for="anolectivo" class="form-label">Ano Letivo</label>
                            <select id="anolectivo" class="form-control" name="anolectivo" required>
                                @foreach ($config as $conf)
                                <option value="{{ $conf->anoletivo }}">{{ $conf->anoletivo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function acessoNegado() {
        Swal.fire({
            icon: 'warning',
            title: 'Acesso negado',
            text: 'Você não tem permissão para aprovar matricula',
        });
    }

    function infoAprovado() {
        Swal.fire({
            icon: 'warning',
            title: 'Atenção',
            text: 'A matricula ja se encontra aprovada!',
        });
    }
    /*  function confirmar(url) {
          Swal.fire({
              icon: "warning",
              title: "Tem certeza que deseja confrimar a matricula!??",
              showDenyButton: true,
              showConfirmButton: true,
              confirmButtonText: "Sim",
              denyButtonText: `Não`
          }).then((result) => {
              if (result.isConfirmed) {
                  fetch(url, {
                          method: 'GET',
                          headers: {
                              'Accept': 'application/json', // Definindo que esperamos uma resposta JSON
                              'X-Requested-With': 'XMLHttpRequest' // Tornar a requisição AJAX
                          }
                      }).then(response => response.json()) // Converter a resposta para JSON
                      .then(data => {
                          // Processar a resposta do servidor
                          Swal.fire({
                              icon: 'success',
                              title: 'Sucesso',
                              text: 'Matricula aprovada com sucesso!',
                          }); 
                          location.reload();// Exibe a mensagem de sucesso
                          // Aqui você pode atualizar a página ou realizar outras ações
                      })
              } 
          });
      }*/

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