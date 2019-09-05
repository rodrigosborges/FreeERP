@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Tipo de Unidade')
@section('body')
<table class="table text-center ">
    <thead class="">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Qtd Itens</th>
            <th scope='col' colspan=2>Ações</th>
            <th>
                <a class="btn btn-success btn-md" href="{{url('/estoque/tipo-unidade/create')}}">
                    <i class="material-icons">note_add</i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($tipos as $tipo)
        <tr>
            <td>{{$tipo->id}}</td>
            <td>{{$tipo->nome}}</td>
            <td>{{$tipo->quantidade_itens}}</td>
            <td>
                <a class="btn btn-lg btn-warning" href="{{url('estoque/tipo-unidade/'.$tipo->id .'/edit')}}">
                    <i class="material-icons">border_color</i>
                </a>
            </td>
            <td>
                <form method="POST" action="{{url('estoque/tipo-unidade/'.$tipo->id)}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-lg btn-danger">

                        <i class="material-icons">delete</i>
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
@endsection