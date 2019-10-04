@extends('calendario::template/index')

@section('title', 'Convites')

@section('content')
    @parent
    <div class="container">
        <h2>Convites</h2>
        @if($convites['pendentes']->isNotEmpty())
            <p class="text-secondary">Confirme presença (ou não) nos eventos que foi convidado.</p>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Solicitante</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($convites['pendentes'] as $convite)
                    <tr>
                        <td>{{$convite->evento->titulo}}</td>
                        <td>{{$convite->evento->nota}}</td>
                        @if($convite->evento->dia_todo == true)
                            <td>{{ \Carbon\Carbon::parse($convite->evento->data_inicio)->format('d/m/Y')}}</td>
                        @else
                            <td>{{\Carbon\Carbon::parse($convite->evento->data_inicio)->format('d/m/Y H:i')}} até
                                {{\Carbon\Carbon::parse($convite->evento->data_fim)->format('d/m/Y H:i')}}
                            </td>
                        @endif
                        <td>{{$convite->evento->agenda->funcionario_id}}</td>
                        <td class="acoes">
                            <a href="{{route('convites.aceitar', $convite->id)}}" class="btn btn-secondary btn-sm text-white small">
                                <i class="material-icons">thumb_down</i>
                            </a>
                            <a href="{{route('convites.aceitar', $convite->id)}}" class="btn btn-success btn-sm text-white small">
                                <i class="material-icons">thumb_up</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>
                Não há nenhum convite para evento aguardando confirmação.
            </p>
        @endif
        @if($convites['definidos']->isNotEmpty())

        @endif
    </div>
@endsection
