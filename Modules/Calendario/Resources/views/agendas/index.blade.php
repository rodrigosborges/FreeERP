@extends('calendario::template/index')

@section('title', 'Agendas')

@section('content')
    @parent
    <div class="container">
        <div class="controles clearfix">
            <div class="float-right">
                @if($lixeira > 0)
                    <a class="btn btn-secondary btn-sm lixeira" data-toggle="tooltip" title="Mostrar lixeira">
                        <i class="material-icons">delete</i>
                    </a>
                @endif
            </div>
            <div class="float-left">
                <a class="btn btn-success btn-sm novo" href="{{route('agendas.criar')}}" data-toogle="tooltip" title="Nova agenda">
                    <i class="material-icons">add</i>
                </a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Descrição</th>
                <th scope="col">Eventos</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($agendas as $agenda)
                <tr @if($agenda->trashed()) class="trashed" @endif>
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
                    </td>
                    <td class="acoes">
                        @if($agenda->trashed())
                            <form method="POST" action="{{route('agendas.deletar', $agenda->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Deletar permanentemente">
                                    <i class="material-icons">delete_forever</i>
                                </button>
                            </form>
                            <form method="POST" action="{{route('agendas.restaurar', $agenda->id)}}">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" title="Restaurar">
                                    <i class="material-icons">restore_from_trash</i>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{route('agendas.deletar', $agenda->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Deletar">
                                    <i class="material-icons">delete</i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            @if($agendas->count() == $lixeira)
                <tr class="vazio">
                    <td colspan="5" class="text-center ">Nenhuma agenda cadastrada.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    @parent
    <style type="text/css">
        .trashed {
            background-color: #f9d6d5 !important;
            display: none;
        }

        .controles {
            margin-bottom: 10px;
            color: #ffffff;
        }

        .acoes button {
            float: right;
            margin-left: 5px;
        }
    </style>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
        $(function () {
            $('.lixeira').on('click', function () {
                $('.trashed').toggle(function () {
                    if ($(this).is(':visible')) {
                        $('.lixeira').removeClass('btn-secondary').addClass('btn-info');
                        $('.vazio').hide();
                    } else {
                        $('.lixeira').removeClass('btn-info').addClass('btn-secondary');
                        $('.vazio').show();
                    }
                });

            });
        });
    </script>
@endsection
