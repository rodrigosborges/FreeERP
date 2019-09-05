@extends('template')
@section('title','Categorias')
@section('content')




<hr>
<div class="row justify-content-center">
    <div class="card col-md-12">
        <div class="header">
            <h3 class="text-center card-header">Categorias</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs  justify-content-center">
                <li class="nav-item">
                    <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab">
                        Categorias Ativas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#inativos" class="nav-link" role="tab" data-toggle="tab">
                        Categorias Inativas
                    </a>
                </li>
            </ul>
            <div class=" tab-content row justify-content-center ">
                <div class="tab-pane active col-sm-10" role="tabpanel1" id="ativos">
                    <table class="table text-center table-striped ">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope='col'>Ações</th>
                                <th>
                                    <a class="btn btn-outline-success btn-md" href="{{url('/estoque/produto/categoria/create')}}">
                                        <i class="material-icons">note_add</i>Adicionar
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->nome}}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-warning" href="{{url('estoque/produto/categoria/'.$categoria->id. '/edit')}}">
                                        <i class="material-icons">border_color</i>Editar
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{{url('estoque/produto/categoria/'. $categoria->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">

                                            <i class="material-icons">delete</i> <span style="float:right">Remover<span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <p class="text-cetner">
                                        Página {{$categorias->currentPage()}} de {{$categorias->lastPage()}}
                                        -Exibido {{$categorias->perPage()}} registro(s) por página. Total de itens: {{$categorias->total()}}
                                    </p>
                                </td>
                            </tr>
                            @if($categorias->lastPage() > 1)
                            <tr>
                                <td colspan="100%" class="text-center">
                                    {{ $categorias->links() }}
                                </td>
                            </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
                <div class="tab-pane col-sm-8" role="tabpanel1" id="inativos">

                    <div class="justify-content-center">
                        <table class="table text-center  table-striped ">
                            <thead class="table-dark">
                                <td><strong>ID</strong></td>
                                <td><strong>Nome</strong></td>
                                <td><strong>Ação</strong></td>
                            </thead>
                            <tbody>
                                @foreach($categoriasInativas as $inativa)
                                <tr>
                                    <td>{{$inativa->id}}</td>
                                    <td>{{$inativa->nome}}</td>
                                    <td>
                                        <form method="POST" action="{{url('estoque/produto/categoria/restore/'.$inativa->id)}}">
                                            @method('put')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-info"> <i class="material-icons">restore_from_trash</i>Restaurar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        <p class="text-cetner">

                                            Página {{$categoriasInativas->currentPage()}} de {{$categoriasInativas->lastPage()}}
                                            -Exibido {{$categoriasInativas->perPage()}} registro(s) por página. Total de itens: {{$categoriasInativas->total()}}
                                        </p>
                                    </td>
                                </tr>
                                @if($categoriasInativas->lastPage() > 1)
                                <tr>
                                    <td colspan="100%" class="text-center">
                                        {{ $categoriasInativas->links() }}
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
</div>
@endsection