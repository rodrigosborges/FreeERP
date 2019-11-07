@extends('estoquemadeireira::estoque.template')

@section('title', 'Estoque Madeireira')

@section('body')


@if($flag==0)
<table class="table text-center ">
<div class="header text-left mb-3 mt-3">
                <h4>Pesquisar Estoque</h4>
            </div>
                <form method="POST" action="{{url('/estoquemadeireira/buscar')}}" id="form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-11">
                            <input id="search-input" placeholder="Insira o nome do produto" maxlength="45" class="form-control" type="text" name="pesquisa" />
                        </div>
                        <div class="form-group col-1">
                            <button type="submit" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                        </div>
                    </div>
                        
                    </div>
                </form>



    <thead class="">

    <div class="col-12 text-right mb-4">
    <a class="btn btn-success btn-sm"  href="{{url('/estoquemadeireira/create')}}">
    <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar
    </a>
    <a class="btn btn-danger btn-sm" href="{{url('/estoquemadeireira/inativos')}}">
    <i class="material-icons" style="vertical-align:middle; font-size:25px;">delete</i>Inativos
    </a>
    </div>
    
        
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Categoria</th>
            <th scope="col">Tipo</th>
            <th scope="col">Quantidade</th>
            <th scope='col'>Gerenciar Estoque</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)
        <tr>
            <td>{{$item->produtos->last()->nome}}</td>
            <td>{{$item->produtos->last()->categoria->nome}}</td>
            <td>{{$item->tipoUnidade->nome}} </td>
            <td>{{$item->quantidade}}</td>
            <td>
                <a href="{{url('/estoquemadeireira/movimentacao/alterar/' . $item->id)}}"><button class="btn btn-primary btn-sm" style="font-size:0px"> <i class="material-icons" style="font-size:18px;">list</i></button></a>
            </td>
            <td>
                <a class="btn btn-sm btn-warning" style="font-size:0px" href="{{url('estoquemadeireira/'.$item->id.'/edit')}}">
                    <i class="material-icons" style="font-size:18px;">border_color</i>
                </a>
            </td>
            <td>
                <form method="POST" action="{{url('estoquemadeireira/'.$item->id )}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" style="font-size:0px">

                        <i class="material-icons" style="font-size:18px;">delete</i>
                    </button>
                </form>
            </td>
        </tr> @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="100%" class="text-center">
                <p class="text-cetner">
                    Página {{$itens->currentPage()}} de {{$itens->lastPage()}}
                    -Exibido {{$itens->perPage()}} registro(s) por página de {{$itens->total()}}
                </p>
            </td>
        </tr>
        @if($itens->lastPage() > 1)
        <tr>
            <td colspan="100%" class="text-center">
                {{ $itens->links() }}
            </td>
        </tr>
        @endif
    </tfoot>
</table>
@else

<table class="table text-center ">

    <thead class="">

    <div class="col-12 text-right mb-4">
    <a class="btn btn-info btn-sm" href="{{url('/estoquemadeireira')}}">
        <i class="material-icons" style="vertical-align:middle; font-size:25px;">keyboard_backspace</i>Voltar</a>
    </div>
        
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            
            <th scope="col">Categorias</th>
            <th scope="col">Tipo</th>
            <th scope="col">Quantidade</th>
            <th scope='col'>Restaurar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itensInativos as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->produtos->last()->nome}}</td>
            <td>{{$item->produtos->last()->categoria->nome}}</td>
            <td>{{$item->tipoUnidade->nome}}-({{$item->tipoUnidade->quantidade_itens}} itens)</td>
            <td>{{$item->quantidade}}</td>
          
            <td>
            <form method="POST" action="{{url('estoquemadeireira/'.$item->id . '/restore')}}">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-info"> <i class="material-icons">restore_from_trash</i></button>
                </form>
            </td>
        </tr> 
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="100%" class="text-center">
                <p class="text-cetner">
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="100%" class="text-center">
            </td>
        </tr>
    </tfoot>
</table>
@endif
@endsection