@extends('calendario::template/index')

@section('title', 'Convites')

@section('content')
    @parent
    <div class="container">
        <h2>Convites</h2>
        @if($convites['pendentes']->isEmpty() && $convites['definidos']->isEmpty())
            <p>Não há nenhum convite para evento.</p>
        @endif
        @if($convites['pendentes']->isNotEmpty())
            <p class="text-secondary">Aguardando confirmação:</p>
            <table class="convites table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Evento</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Responsável</th>
                    <th scope="col">Criado</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($convites['pendentes'] as $convite)
                    <tr>
                        <td>{{$convite->evento->titulo}}</td>
                        <td>
                            @if($convite->evento->nota)
                                {{$convite->evento->nota}}
                            @else
                                ---
                            @endif
                        </td>
                        @if($convite->evento->dia_todo == true)
                            <td>{{ \Carbon\Carbon::parse($convite->evento->data_inicio)->format('d/m/Y')}}</td>
                        @else
                            <td>{{\Carbon\Carbon::parse($convite->evento->data_inicio)->format('d/m/Y H:i')}} até
                                {{\Carbon\Carbon::parse($convite->evento->data_fim)->format('d/m/Y H:i')}}
                            </td>
                        @endif
                        <td>{{$convite->evento->agenda->funcionario->nome}}</td>
                        <td>{{\Carbon\Carbon::parse($convite->created_at)->format('d/m/Y H:i')}}</td>
                        <td class="acoes">
                            <a href="{{route('convites.deletar', $convite->id)}}" class="btn btn-secondary btn-sm text-white small deletar-convite">
                                <i class="material-icons">delete</i>
                            </a>
                            <a href="{{route('convites.aceitar', $convite->id)}}" class="btn btn-success btn-sm text-white small aceitar-convite">
                                <i class="material-icons">thumb_up</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if($convites['definidos']->isNotEmpty())
            <p class="text-secondary">Aceitos e/ou recusados:</p>
            <table class="convites table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Evento</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Responsável</th>
                    <th scope="col">Criado</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($convites['definidos'] as $convite)
                    <tr>
                        <td>{{$convite->evento->titulo}}</td>
                        <td>
                            @if($convite->evento->nota)
                                {{$convite->evento->nota}}
                            @else
                                ---
                            @endif
                        </td>
                        @if($convite->evento->dia_todo == true)
                            <td>{{ \Carbon\Carbon::parse($convite->evento->data_inicio)->format('d/m/Y')}}</td>
                        @else
                            <td>{{\Carbon\Carbon::parse($convite->evento->data_inicio)->format('d/m/Y H:i')}} até
                                {{\Carbon\Carbon::parse($convite->evento->data_fim)->format('d/m/Y H:i')}}
                            </td>
                        @endif
                        <td>{{$convite->evento->agenda->funcionario->nome}}</td>
                        <td>{{\Carbon\Carbon::parse($convite->created_at)->format('d/m/Y H:i')}}</td>
                        <td class="acoes">
                            <a href="{{route('convites.revogar', $convite->id)}}" class="btn btn-info btn-sm text-white small revogar-convite">
                                <i class="material-icons">redo</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('js')
    @parent
    @include('calendario::eventos.js')
@endsection
