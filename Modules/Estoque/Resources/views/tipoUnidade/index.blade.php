@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Tipo de Unidade')
@section('body')
    <div class="col-12 text-right mb-4">
        <a class="btn btn-success btn-sm text-right" href="{{url('/estoque/tipo-unidade/create')}}">
            <i class="material-icons" style="vertical-align: middle; font-size:25px;">note_add</i>Adicionar
        </a>
    
        <a class="btn btn-danger btn-sm" href="{{url('/estoque/tipo-unidade/inativos')}}">
            <i class="material-icons" style="vertical-align: middle; font-size:25px;">delete</i>Inativos
        </a>
    </div>
@if($flag==1)
<table class="table text-center table-striped ">
   
    <thead class="card-header">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope='col'>Editar</th>
            <th scope='col'>Remover</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tipos as $tipo)
        <tr>
            <td>{{$tipo->id}}</td>
            <td>{{$tipo->nome}}</td>
            <td>{{$tipo->quantidade_itens}}</td>
            <td>
                <a class="btn btn-sm btn-warning" style="font-size:0px" href="{{url('estoque/tipo-unidade/'.$tipo->id .'/edit')}}">
                    <i class="material-icons" style="font-size:18px;">border_color</i>
                </a>
            </td>
            <td>
                <form method="POST" action="{{url('estoque/tipo-unidade/'.$tipo->id)}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" style="font-size:0px">

                        <i class="material-icons" style="font-size:18px;">delete</i>
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

<table class="table text-center table-striped ">
    <thead class="card-header">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope='col' colspan=2>Ações</th>

        </tr>
    </thead>
    <tbody>
        @foreach($inativos as $tipo)
        <tr>
            <td>{{$tipo->id}}</td>
            <td>{{$tipo->nome}}</td>
            <td>{{$tipo->quantidade_itens}}</td>

            <td>
                <form method="POST" action="{{url('estoque/tipo-unidade/'.$tipo->id . '/restore')}}">
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