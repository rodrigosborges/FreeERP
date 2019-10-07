@extends('calendario::template/index')

@section('title', 'Eventos')

@section('content')
    @parent
    <div class="container">
        <h2>{{$agenda->titulo}} > Eventos</h2>
        <div class="controles clearfix">
            <div class="float-right">
            </div>
            <div class="float-left">
                <a class="btn btn-primary btn-sm novo" href="{{route('eventos.criar', ['agenda' => $agenda->id])}}" data-toogle="tooltip" title="Novo evento">
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
                    <th scope="row">{{$evento->id}}</th>
                    <td><a href="{{route('eventos.editar', $evento->id)}}">{{$evento->titulo}}</a></td>
                    @if($evento->dia_todo == true)
                        <td>{{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y')}}</td>
                    @else
                        <td>{{\Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y H:i')}} até
                            {{\Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y H:i')}}
                        </td>
                    @endif
                    <td>@if($evento->nota){{$evento->nota}}@else --- @endif</td>
                    <td class="acoes">
                        <form method="POST" action="{{route('eventos.deletar', $evento->id)}}" id="formEvDel">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Deletar evento">
                                <i class="material-icons">delete</i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Essa agenda ainda não possui eventos cadastrados.</td>
                </tr>
            @endforelse
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
    <script type="text/javascript">
        $(function () {
            $('#formEvDel button').on('click', function () {
                bootbox.confirm({
                    title: 'Confirmar ação',
                    message: 'Deseja realmente excluir o evento?',
                    onEscape: true,
                    backdrop: true,
                    locale: 'br',
                    callback: function (result) {
                        if(result == true){
                            $('#formEvDel').submit();
                        }
                    }
                });
            });
        });
    </script>
@endsection
