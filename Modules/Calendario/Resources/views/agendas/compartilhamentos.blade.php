@extends('calendario::template/index')

@section('title', 'Compartilhamentos')

@section('content')
    @parent
    <div class="container">
        <h2>Compartilhamentos</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th scope="col">Descrição</th>
                <th>Solicitante</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($solicitacoes as $solicitacao)
                <tr>
                    <td>{{$solicitacao->agenda->id}}</td>
                    <td>{{$solicitacao->agenda->titulo}}</td>
                    <td>{{isset($solicitacao->agenda->descricao) ? $solicitacao->agenda->descricao : '---'}}</td>
                    <td>{{$solicitacao->agenda->funcionario_id}}</td>
                    <td>
                        <a href="{{route('compartilhamentos.aprovar', $solicitacao)}}" class="btn btn-success text-white">Aprovar</a>
                        <a class="btn btn-danger text-white">Excluir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhuma aprovação pendente</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
    </script>
@endsection
