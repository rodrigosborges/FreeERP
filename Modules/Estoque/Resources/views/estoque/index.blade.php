@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Estoque')
@section('body')
@if($flag==0)
<table class="table text-center ">

    <thead class="">
    <a class="btn btn-outline-primary btn-sm mb-4" href="{{url('/estoque/inativos')}}">
            <i class="material-icons" style="vertical-align:middle; font-size:25px;">restore_from_trash</i>Itens Inativos
        </a>
    <a class="btn btn-outline-success btn-sm mb-4"  href="{{url('/estoque/create')}}">
            <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar
        </a>
        
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            
            <th scope="col">Categorias</th>
            <th scope="col">Tipo</th>
            <th scope="col">Quantidade</th>
            <th scope='col'>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->produtos->last()->nome}}</td>
            <td>{{$item->produtos->last()->categoria->nome}}</td>
            <td>{{$item->tipoUnidade->nome}}-({{$item->tipoUnidade->quantidade_itens}} itens)</td>
            <td>{{$item->quantidade}}</td>
            <td>
                <a class="btn btn-lg btn-warning" href="{{url('estoque/'.$item->id.'/edit')}}">
                    <i class="material-icons">border_color</i>
                </a>
            </td>
            <td>
                <form method="POST" action="{{url('estoque/'.$item->id )}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-lg btn-danger">

                        <i class="material-icons">delete</i>
                    </button>
                </form>
            </td>
        </tr> @endforeach
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
@else

<table class="table text-center ">

    <thead class="">

    <a class="btn btn-success btn-sm mb-4" style="float:right;" href="{{url('/estoque/create')}}">
            <i class="material-icons" style="vertical-align:middle; font-size:25px;">note_add</i>Adicionar
        </a>
        
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
            <form method="POST" action="{{url('estoque/'.$item->id . '/restore')}}">
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