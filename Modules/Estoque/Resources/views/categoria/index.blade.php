@extends('estoque::template2')
@section('title','Categorias')
@section('body')



<div class="row justify-content-center">

        <div class="card-body">
        
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a href="{{url('/estoque/produto/categoria')}}" class="nav-link active" >
                        Categorias Ativas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/estoque/produto/categoria/inativos')}}" class="nav-link active" >
                        Categorias Inativas
                    </a>
                </li>
             
            </ul>
            <div class="tab-content row justify-content-center">
                <div class="tab-pane active col-sm-10" role="tabpanel1" id="ativos">
                @if($flag ==0)
                    <table class="table text-center table-striped ">
                        <thead class="card-header">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->nome}}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" style="font-size:0px" href="{{url('estoque/produto/categoria/'.$categoria->id. '/edit')}}">
                                        <i class="material-icons" style="font-size:18px;">border_color</i>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{{url('estoque/produto/categoria/'. $categoria->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" style="font-size:0px" class="btn btn-sm btn-danger">

                                            <i class="material-icons" style="font-size:18px;">delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                               
                            	
                        </tbody>
                        <div class="col-12 text-right">
                        <a class="btn btn-success btn-sm mt-3 mb-3" href="{{url('/estoque/produto/categoria/create')}}">
                                    <i class="material-icons" style="vertical-align:middle;">note_add</i>  Adicionar
                                </a>
                        </div>
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
                    @else
                    <table class="table text-center  table-striped mt-5">
                            <thead class="card-header">
                               
                                <td><strong>Nome</strong></td>
                                <td><strong>Restaurar</strong></td>
                            </thead>
                            <tbody>
                                @foreach($categoriasInativas as $inativa)
                                <tr>
                                   
                                    <td>{{$inativa->nome}}</td>
                                    <td>
                                        <form method="POST" action="{{url('estoque/produto/categoria/restore/'.$inativa->id)}}">
                                            @method('put')
                                            @csrf
                                            <button type="submit" style="font-size:0px" class="btn btn-sm btn-info"> <i class="material-icons" style="font-size:18px;">restore_from_trash</i></button>
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
                        @endif
                </div>
              </div>
        </div>
        </div>
        
    

@endsection