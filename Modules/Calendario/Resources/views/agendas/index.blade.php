@extends('calendario::template/index')

@section('title', 'Agendas')

@section('content')
    @parent
    <div class="container">
        <h2>Minhas Agendas</h2>
        <div class="controles clearfix">
            <div class="float-right">
                @if($lixeira > 0)
                    <a class="btn btn-secondary btn-sm lixeira" data-toggle="tooltip" title="Mostrar lixeira">
                        <i class="material-icons">delete</i>
                    </a>
                @endif
            </div>
            <div class="float-left">
                <a class="btn btn-primary btn-sm novo" href="{{route('agendas.criar')}}" data-toogle="tooltip" title="Nova agenda">
                    <i class="material-icons">add</i>
                </a>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Descrição</th>
                <th scope="col">Eventos</th>
                <th scope="col" class="text-center">Compartilhamentos</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($agendas as $agenda)
                <tr class="agendas @if($agenda->trashed()) trashed @endif">
                    <th scope="row">{{$agenda->id}}</th>
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
                        @if(!$agenda->trashed())
                            <a class="btn btn-link novo-evento invisible" href="{{route('eventos.criar', ['agenda' => $agenda->id])}}" data-toogle="tooltip"
                               title="Novo evento">
                                <i class="material-icons">add</i>
                            </a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($agenda->compartilhamentos->count())
                            @foreach($agenda->compartilhamentos as $compartilhamento)
                                {{$compartilhamento->setor->sigla}}
                                @if(!$compartilhamento->aprovacao)
                                    <i class="material-icons align-middle" style="font-size: 18px" title="Pendente de aprovação">info</i>
                                @endif
                                @if (!$loop->last)
                                    |
                                @endif
                            @endforeach
                        @else
                            ---
                        @endif
                    </td>
                    <td class="acoes">
                        @if($agenda->trashed())
                            <form method="POST" action="{{route('agendas.deletar', $agenda->id)}}" id="formAgDelPerm">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Deletar agenda permanentemente">
                                    <i class="material-icons">delete_forever</i>
                                </button>
                            </form>
                            <form method="POST" action="{{route('agendas.restaurar', $agenda->id)}}" id="formAgRec">
                                @method('PATCH')
                                @csrf
                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="Restaurar agenda">
                                    <i class="material-icons">restore_from_trash</i>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{route('agendas.deletar', $agenda->id)}}" id="formAgDel">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Deletar agenda">
                                    <i class="material-icons">delete</i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            @if($agendas->count() == $lixeira)
                <tr class="vazio">
                    <td colspan="6" class="text-center">Nenhuma agenda cadastrada.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    @parent
    <style type="text/css">
        .acoes form{
            display: inline;
        }
    </style>
@endsection

@section('js')
    @parent
    @include('calendario::agendas.js')
@endsection
