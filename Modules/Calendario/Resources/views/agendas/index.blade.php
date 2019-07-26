@extends('calendario::template/index')

@section('title', 'Calendário - Agendas')

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
            </tr>
            </thead>
            <tbody>
            @forelse($agendas as $agenda)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        <a href="{{route('agendas.editar', $agenda->id)}}">{{$agenda->titulo}}</a></td>
                    </a>
                    <td>{{$agenda->descricao}}</td>
                    <td>{{$agenda->eventos->count()}}</td>
                </tr>
            @empty
                <tr>
                    <td>Nenhuma agenda disponível.</td>
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
