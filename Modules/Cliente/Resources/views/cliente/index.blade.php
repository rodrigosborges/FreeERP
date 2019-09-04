@extends('cliente::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header row">
            <div class="col-12">
                <h3>Lista de clientes...</h3>
            </div>
            <form class="input-group col-lg-7 col-sm-10" action="" method="post">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="busca" placeholder="Índice de busca">
                <div class="input-group-append">
                    <input class="btn btn-outline-success" type="submit" value="Localizar" id="button-addon2">
                </div>
            </form>
        </div>
            
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos"
                    aria-selected="true">Ativos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos"
                    aria-selected="false">Inativos</a>
            </li>

        </ul>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    </thead>
                    <tbody>
                        <tr scope="row">
                            <th scope="col">Nome</th>
                            <th scope="col">Documento</th>
                        </tr>
                        @foreach ($clientes as $cliente)
                        <tr scope="row">
                            <td>{{$cliente->nome}}</td>
                            <td>{{$cliente->documento->numero}}</td> <!-- tratar isso -->
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
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    

    
@stop
