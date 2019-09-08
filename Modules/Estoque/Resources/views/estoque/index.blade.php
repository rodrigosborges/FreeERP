@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Estoque')
@section('body')
<table class="table text-center ">
    <thead class="">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope='col'>Ações</th>
            <th>
                <a class="btn btn-success btn-md" href="{{url('/estoque/create')}}">
                    <i class="material-icons">note_add</i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td></td>
            <td>
                <a class="btn btn-lg btn-warning" href="">
                    <i class="material-icons">border_color</i>
                </a>
            </td>
            <td>
                <form method="POST" action="">
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
@endsection