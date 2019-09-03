@extends('usuario::layouts.informacoes')

@section('content')
<div class="row justify-content-center align-items-center" style="height:100%">
    <div class="col-xm-12 col-sm-10 col-md-8">
        <div class="d-flex align-self-start">
        <a href="modulo/cadastrar"  style="text-decoration: none">
            <buttom class="btn btn-success d-flex mb-3" style="">
                <i class="material-icons mr-2">post_add</i>Cadastrar novo módulo
            </buttom>
        </a>
        </div>
        
        <form class="d-flex" action="" method="get">
            <input type="text" name="nome" class="form-control" placeholder="Nome do módulo">
            <button type="submit" class="btn btn-primary d-flex ml-2">
                <i class="material-icons mr-2">search</i>
                Buscar
            </button>
        </form>

        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">Modulos</h5>
            </div>
            <div class="card-body pb-0 d-flex flex-column align-items-start">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-todosModulos-tab" data-toggle="tab" href="#nav-todosModulos" role="tab" aria-controls="nav-todosModulos" aria-selected="true">Todos</a>
                        <a class="nav-item nav-link" id="nav-modulosAtivos-tab" data-toggle="tab" href="#nav-modulosAtivos" role="tab" aria-controls="nav-modulosAtivos" aria-selected="false">Ativos</a>
                        <a class="nav-item nav-link" id="nav-modulosInativos-tab" data-toggle="tab" href="#nav-modulosInativos" role="tab" aria-controls="nav-modulosInativos" aria-selected="false">Inativos</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent" style="width:100%">
                    <div class="tab-pane fade show active" id="nav-todosModulos" role="tabpanel" aria-labelledby="nav-todosModulos-tab">
                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Icone</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($todosModulos as $modulo)
                                    <tr id="todosModulos">
                                        <td>{{ $modulo->nome }}</td>
                                        <td><i class="material-icons">{{ $modulo->icone }}</i></td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                @if(!$modulo->trashed())
                                                <form method="GET" action="{{url('modulo/'.$modulo->id.'/edit')}}">
                                                    @csrf
                                                    <button class="text-warning" type="submit" style="border: 0; background: none; cursor: pointer">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{url('modulo/'.$modulo->id)}}">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="text-danger" type="submit" style="border: 0; background: none; cursor: pointer">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </form>
                                                @else
                                                <form method="POST" action="{{url('modulo/'.$modulo->id.'/restore')}}">
                                                    @method('put')
                                                    @csrf
                                                    <button class="text-success" type="submit" style="border: 0; background: none; cursor: pointer">
                                                        <i class="material-icons">restore_from_trash</i>
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
                    <div class="tab-pane fade" id="nav-modulosAtivos" role="tabpanel" aria-labelledby="nav-modulosAtivos-tab">
                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Icone</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modulosAtivos as $modulo)
                                    <tr id="modulosAtivos">
                                        <td>{{ $modulo->nome }}</td>
                                        <td><i class="material-icons">{{ $modulo->icone }}</i></td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                @if(!$modulo->trashed())
                                                <form method="GET" action="{{url('modulo/'.$modulo->id.'/edit')}}">
                                                    @csrf
                                                    <button class="text-warning" type="submit" style="border: 0; background: none; cursor: pointer">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{url('modulo/'.$modulo->id)}}">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="text-danger" type="submit" style="border: 0; background: none; cursor: pointer">
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
                    <div class="tab-pane fade" id="nav-modulosInativos" role="tabpanel" aria-labelledby="nav-modulosInativos-tab">
                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Icone</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modulosInativos as $modulo)
                                    <tr id="modulosInativos">
                                        <td>{{ $modulo->nome }}</td>
                                        <td><i class="material-icons">{{ $modulo->icone }}</i></td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <form method="POST" action="{{url('modulo/'.$modulo->id.'/restore')}}">
                                                    @method('put')
                                                    @csrf
                                                    <button class="text-success" type="submit" style="border: 0; background: none; cursor: pointer">
                                                        <i class="material-icons">restore_from_trash</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <nav class="align-self-center" aria-label="Page navigation example">
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
<script>
    function filterContent() {
        console.log();
    }
</script>
@endsection