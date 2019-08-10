@extends('calendario::template/index')

@section('title', 'Agendas')

@section('content')
    @parent
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Descrição</th>
                <th scope="col">Eventos</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($agendas as $agenda)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        <a href="{{route('agendas.editar', $agenda->id)}}">{{$agenda->titulo}}</a></td>
                    </a>
                    <td>@if($agenda->descricao){{$agenda->descricao}} @else --- @endif</td>
                    <td>
                        @if($agenda->eventos->count() > 0)
                            <a href="{{route('agendas.eventos.index', $agenda->id)}}">{{$agenda->eventos->count()}}</a>
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{route('agendas.deletar', $agenda->id)}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Nenhuma agenda cadastrada.</td>
                    <td></td><td></td><td></td><td></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    @parent
    <style type="text/css">
    </style>
@endsection

@section('js')
    @parent
    <script type="text/javascript">

    </script>
@endsection
