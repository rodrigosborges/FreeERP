@extends('usuario::layouts.informacoes')

@section('content')
    <nav class="nav nav-tabs">
    <a href="#ativos" data-toggle="tab" class="nav-item nav-link active show">
        Ativos
    </a>
    <a href="#inativos" data-toggle="tab" class="nav-item nav-link">
        Inativos
    </a>
</nav>

<div class="tab-content">
    <div id="ativos" class="tab-pane fade in active show">
        <div class="text-center">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Apelido</th>
                        <th>Avatar</th>
                        <th>E-mail</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->apelido}}</td>
                            <td>{{$usuario->avatar}}</td>
                            <td>{{$usuario->email}}</td>
                            <td><a  href="{{url('/usuario/' . $usuario->id.'/edit')}}"><button type="button" class=" btn-sm btn btn-success">Editar</button></a></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Trocar Senha</button></td>
                            <td><form method="POST" action="{{url('/usuario/' . $usuario->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn-sm btn btn-danger">Deletar</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="inativos" class="tab-pane fade">
        <div class="text-center">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Apelido</th>
                        <th>Avatar</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                     </tr>
                </thead>
                <tbody>
                    @foreach($usuariosInativos as $usuario)
                        <tr>
                        <td>{{$usuario->apelido}}</td>
                            <td>{{$usuario->avatar}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>
                                <form method="POST" action="{{url('usuario/restore/'.$usuario->id)}}">
                                    @method('put')
                                    @csrf
                                    <button type="submit">Restaurar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
    </div>
    <button><a href="{{url('usuario/cadastrar')}}">Novo</a></button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection