@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Unidades inativas')
@section('body')
<table class="table text-center ">
    <thead class="">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Qtd Itens</th>
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
@endsection
