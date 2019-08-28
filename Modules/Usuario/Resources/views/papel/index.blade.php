@extends('usuario::layouts.informacoes')


@section('content')
    <h2>Papéis ativos</h2>
    <table border=1>
        <tr>
            <th>Nome</th>
            <th colspan="2">Ações</th>
        </tr>
        @foreach($papeis as $papel)
            <tr>
                <td>{{$papel->nome}}</td>
                <td><a href="{{url($papel->id.'/edit')}}"><button>Editar</button></a></td>
                <td>
                    <form method="POST" action="{{url($papel->id)}}">
                        @method('delete')
                        @csrf
                        <button type="submit">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection