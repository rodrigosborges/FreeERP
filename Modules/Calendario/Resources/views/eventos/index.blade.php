@extends('calendario::template/index')

@section('title', 'Eventos')

@section('content')
    @parent
    <div class="container">
        <div class="controles clearfix">
            <div class="float-right">
            </div>
            <div class="float-left">
                <a class="btn btn-primary btn-sm novo" href="{{route('eventos.criar')}}" data-toogle="tooltip" title="Novo evento">
                    <i class="material-icons">add</i>
                </a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Data</th>
                <th scope="col">Descrição</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($eventos as $evento)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><a href="{{route('eventos.editar', $evento->id)}}">{{$evento->titulo}}</a></td>
                    @if($evento->dia_todo == true)
                        <td>{{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y')}}</td>
                    @else
                        <td>{{\Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y H:i')}} até
                            {{\Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y H:i')}}
                        </td>
                    @endif
                    <td>@if($evento->nota){{$evento->nota}}@else --- @endif</td>
                    <td>
                        <form method="POST" action="{{route('eventos.deletar', $evento->id)}}">
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
                    <td>Essa agenda não possui eventos.</td>
                    <td></td><td></td><td></td><td></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
