@extends('usuario::layouts.informacoes')
@section('content')

<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10">
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0 ">Usuários</h5>
                <a href="{{url('usuario/cadastrar')}}" style="text-decoration: none; padding:0">
                    <button class="text-success d-flex align-items-center p-0" style="background: none; border: 0; cursor: pointer;" type="submit" title="Cadastrar">
                        <i class="material-icons" style="font-size: 32px">add</i>
                    </button>
                </a>
            </div>
            <div class="card-body bg-light pb-0">
                <form class="d-flex mb-3" action="" method="get">
                    <input type="text" name="busca" class="form-control" placeholder="Buscar Usuário">
                    <button class="text-primary d-flex align-items-center ml-2" style="background: none; border: 0; cursor: pointer" type="submit" title="Buscar">
                        <i class="material-icons">search</i>
                    </button>
                </form>
                @if(isset($busca))
                    <p class="ml-1">
                        <i>
                            Exibindo resultados para: <b>{{ $busca }}</b>
                            <a class="ml-4" href="{{ url('usuario') }}">Limpar Busca</a>
                        </i>
                    </p>
                @endif
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-usuarios-tab" data-toggle="tab" href="#nav-usuarios" role="tab" aria-controls="nav-usuarios" aria-selected="false">Ativos</a>
                        <a class="nav-item nav-link" id="nav-usuariosInativos-tab" data-toggle="tab" href="#nav-usuariosInativos" role="tab" aria-controls="nav-usuariosInativos" aria-selected="false">Inativos</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent" style="width:100%">
                    <div class="tab-pane fade show active" id="nav-usuarios" role="tabpanel" aria-labelledby="nav-usuarios-tab">
                        <div>
                            <table class="table table-striped table-borderless bg-white" style="border-style: solid; border-color: #dee2e6; border-width: 0 1px 1px 1px;">
                                <thead>
                                    <tr>
                                        <th scope="col">Apelido</th>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Papel</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['usuarios'] as $usuario)
                                    <tr id="usuarios">
                                        <td>{{ $usuario->apelido }}</td>
                                        <td>{{ $usuario->avatar }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->papel->nome }}</td>
                                        <td class="text-center"><i class="material-icons">{{ $usuario->icone }}</i></td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                @if(!$usuario->trashed())
                                                <form method="GET" action="{{url('usuario/'.$usuario->id.'/trocarSenha')}}">
                                                    @csrf
                                                    <button class="text-primary" type="submit" style="border: 0; background: none; cursor: pointer" title="Editar">
                                                        <i class="material-icons">vpn_key</i>
                                                    </button>
                                                </form>
                                                <form method="GET" action="{{url('usuario/'.$usuario->id.'/edit')}}">
                                                    @csrf
                                                    <button class="text-warning" type="submit" style="border: 0; background: none; cursor: pointer" title="Editar">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{url('usuario/'.$usuario->id)}}">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="text-danger" style="background: none; border: 0; cursor: pointer" type="submit" title="Deletar">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-usuariosInativos" role="tabpanel" aria-labelledby="nav-usuariosInativos-tab">
                        <div>
                            <table class="table table-striped table-borderless bg-white" style="border-style: solid; border-color: #dee2e6; border-width: 0 1px 1px 1px;">
                                <thead>
                                    <tr>
                                    
                                    <th scope="col">Apelido</th>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Papel</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @if(isset($usuariosInativos))
                                    @foreach($usuariosInativos as $usuario)
                                    <tr id="usuariosInativos">
                                    <td>{{ $usuario->apelido }}</td>
                                        <td>{{ $usuario->avatar }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->papel->nome }}</td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <form method="POST" action="{{url('usuario/'.$usuario->id.'/restore')}}">
                                                    @method('put')
                                                    @csrf
                                                    <button class="text-success" type="submit" style="border: 0; background: none; cursor: pointer" title="Restaurar">
                                                        <i class="material-icons">restore_from_trash</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection