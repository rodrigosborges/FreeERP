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
            @foreach($agendas as $agenda)
                @if($agenda->compartilhamentos->count())
                    @foreach($agenda->compartilhamentos as $compartilhamento)
                        @if(!$compartilhamento->aprovado)
                            <tr>
                                <td>{{$agenda->id}}</td>
                                <td>{{$agenda->titulo}}</td>
                                <td>{{isset($agenda->descricao) ? $agenda->descricao : '---'}}</td>
                                <td>{{$agenda->funcionario_id}}</td>
                                <td>
                                    <a href="{{route('compartilhamentos.aprovar', $compartilhamento)}}" class="btn btn-success text-white">Aprovar</a>
                                    <a class="btn btn-danger text-white">Excluir</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
    </script>
@endsection
