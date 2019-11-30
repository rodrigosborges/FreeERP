@extends('calendario::template/index')

@section('title', 'Compartilhamentos')

@section('content')
    @parent
    <div class="container">
        <h2>Compartilhamentos</h2>
        @if(!$solicitacoes['pendentes'] && !$solicitacoes['aprovadas'])
            <p>Não há nenhum compartilhamento de agenda aguardando aprovação ou ativo.</p>
        @endif
        @if($solicitacoes['pendentes'])
            <p class="text-secondary">Aguardando aprovação:</p>
            <table class="compartilhamentos table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Agenda</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Solicitante</th>
                    <th scope="col">Data</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($solicitacoes['pendentes'] as $solicitacao)
                    <tr>
                        <td>{{$solicitacao->agenda->titulo}}</td>
                        <td>{{isset($solicitacao->agenda->descricao) ? $solicitacao->agenda->descricao : '---'}}</td>
                        <td>{{$solicitacao->setor->sigla}}</td>
                        <td>{{$solicitacao->agenda->funcionario->nome}}</td>
                        <td>{{\Carbon\Carbon::parse($solicitacao->created_at)->format('d/m/Y H:i')}}</td>
                        <td class="acoes">
                            <a href="{{route('compartilhamentos.deletar', $solicitacao)}}" class="btn btn-secondary btn-sm text-white deletar-compartilhamento" data-toggle="tooltip" title="Excluir solicitação">
                                <i class="material-icons">delete</i>
                            </a>
                            <a href="{{route('compartilhamentos.aprovar', $solicitacao)}}" class="btn btn-success btn-sm text-white aprovar-compartilhamento" data-toggle="tooltip" title="Aprovar compartilhamento">
                                <i class="material-icons">done</i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhuma aprovação pendente</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        @endif

        @if($solicitacoes['aprovadas'])
            <hr>
            <p class="text-secondary">Aprovados:</p>
            <table class="compartilhamentos table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Agenda</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Solicitante</th>
                    <th scope="col">Data</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($solicitacoes['aprovadas'] as $solicitacao)
                    <tr>
                        <td>{{$solicitacao->agenda->titulo}}</td>
                        <td>{{isset($solicitacao->agenda->descricao) ? $solicitacao->agenda->descricao : '---'}}</td>
                        <td>{{$solicitacao->setor->sigla}}</td>
                        <td>{{$solicitacao->agenda->funcionario->nome}}</td>
                        <td>{{\Carbon\Carbon::parse($solicitacao->created_at)->format('d/m/Y H:i')}}</td>
                        <td class="acoes">
                            <a href="{{route('compartilhamentos.revogar', $solicitacao)}}"
                               class="btn btn-info btn-sm text-white small revogar-compartilhamento" data-toggle="tooltip" title="Revogar compartilhamento">
                                <i class="material-icons">redo</i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum compartilhamento ativo</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('js')
    @parent
    @include('calendario::agendas.js')
@endsection
