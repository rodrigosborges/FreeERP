@extends('cliente::template')
@section('content')
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <h3>Lista de clientes...</h3>
            </div>
            <form class="input-group col-lg-7 col-sm-10" action="{{route('cliente.buscar')}}" method="post">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Índice de busca">
                <div class="input-group-append">
                    <input class="btn btn-outline-success" type="submit" value="Localizar" id="button-addon2">
                </div>
            </form>
        </div>
            
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab"  aria-selected="true">Ativos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab"  aria-selected="false">Inativos</a>
            </li>
        </ul>

        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr scope="row">
                                    <th scope="col">Nome</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Telefones</th>
                                    <th colspan=3 scope="col">Ação</th>
                                </tr>
                                @foreach ($clientes as $cliente)
                                <tr scope="row">
                                    <td>{{$cliente->nome}}</td>
                                    <td>{{$cliente->getDocumento()}}</td> 
                                    <td>{{$cliente->telefonesAll()}}</td>
                                    <td><a href="" class="btn btn-primary">Pedidos</a></td>
                                    <td><a href="" class="btn btn-warning">Editar</a></td>
                                    <td>
                                        <form action="{{url('/cliente/cliente/'.$cliente->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Apagar</button>
                                        </form>
                                    </td> 
                                </tr>  
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        <p class="text-center">

                                            {{$clientes->currentPage()}} de {{$clientes->lastPage()}}
                                            páginas

                                        </p>
                                    </td>
                                </tr>
                                @if($clientes->lastPage() > 1)
                                <tr>
                                    <td colspan="100%">
                                        {{ $clientes->links() }}
                                    </td>
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="inativos-tab">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr scope="row">
                                    <th scope="col">Nome</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Telefones</th>
                                    <th scope="col">Ação</th>
                                </tr>
                                @foreach ($clientesDeletados as $cliente)
                                <tr scope="row">
                                    <td>{{$cliente->nome}}</td>
                                    <td>{{$cliente->getDocumento()}}</td> 
                                    <td>{{$cliente->telefonesAll()}}</td>
                                    <td><a href="" class="btn btn-primary">Pedidos</a></td>
                                    <td><a href="" class="btn btn-warning">Editar</a></td>
                                    <td>
                                        <form action="{{url('/cliente/cliente/'.$cliente->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Restaurar</button>
                                        </form>
                                    </td> 
                                </tr>  
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        <p class="text-center">
                                                {{$clientesDeletados->currentPage()}} de {{$clientesDeletados->lastPage()}}
                                            páginas
                                        </p>
                                    </td>
                                </tr>
                                @if($clientesDeletados->lastPage() > 1)
                                <tr>
                                    <td colspan="100%">
                                        {{ $clientesDeletados->links() }}
                                    </td>
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>   
            </div>
             
            
        </div>
        

    </div>
    

    
@stop
