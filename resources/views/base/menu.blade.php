 @can('Administrador')
     <li class="nav-item">
         <a class="nav-link" href="{{ route('config') }}"><i class="fa fa-cog"></i> Configurações</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('turma') }}"><i class="fa fa-home-user"></i>Turmas</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('usuario') }}"><i class="fa fa-user-friends"></i>
             Usuários</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('inscricao') }}"><i class="fa fa-pencil"></i> Inscrições</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('matricula') }}"><i class="fa fa-user-check"></i> Matrículas</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('funcionario') }}"><i class="fa fa-users"></i>
             Funcionarios</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('relatorio') }}"><i class="fa fa-file-edit"></i> Relatórios</a>
     </li>
 @endcan
 @can('Director')
     <li class="nav-item">
         <a class="nav-link" href="{{ route('config') }}"><i class="fa fa-cog"></i> Configurações</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('usuario') }}"><i class="fa fa-user-friends"></i>
             Usuários</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('inscricao') }}"><i class="fa fa-pencil"></i> Inscrições</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('matricula') }}"><i class="fa fa-user-check"></i> Matrículas</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('funcionario') }}"><i class="fa fa-users"></i>
             Funcionarios</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('relatorio') }}"><i class="fa fa-file-edit"></i> Relatórios</a>
     </li>
 @endcan

 @can('Pedagogico')
     <li class="nav-item">
         <a class="nav-link" href="{{ route('inscricao') }}"><i class="fa fa-pencil"></i> Inscrições</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('matricula') }}"><i class="fa fa-user-check"></i> Matrículas</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('relatorio') }}"><i class="fa fa-file-edit"></i> Relatórios</a>
     </li>
 @endcan

 @can('Tecnico')
     <li class="nav-item">
         <a class="nav-link" href="{{ route('inscricao') }}"><i class="fa fa-pencil"></i> Inscrições</a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="{{ route('relatorio') }}"><i class="fa fa-file-edit"></i> Relatórios</a>
     </li>
 @endcan
