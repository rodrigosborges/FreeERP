@extends('funcionario::template')

@section('title')
    {{$data['title']}}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{Module::asset('funcionario:css/frequencia.css')}}">
@endsection

@section('body')

    <div class="row">
        <div class="col-md-8">
            <form id="form">
                <div class="form-group">
                    <div class="input-group">
                        <input id="search-input" class="form-control" type="text" name="pesquisa" />
                        <i id="search-button" class="btn btn-info material-icons ml-2">search</i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordeless">
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th style="width: 240px;">Ações</th>
                            <th width="1px">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['pontos'] as $ponto)
                            <tr>
                                <td>{{ucfirst($ponto->nome_mes)}}</td>
                                <td>{{$ponto->ano}}</td>
                                <td>
                                    <a href='{{ url("funcionario/frequencia/".$ponto->funcionario_id."/xls/".$ponto->ano."/".$ponto->mes) }}' class="btn btn-primary {{$ponto->hasAutomatico == 1 ? 'disabled' : ''}}">XLS</a>
                                    <a target="__blank" href='{{ url("funcionario/frequencia/".$ponto->funcionario_id."/pdf/".$ponto->ano."/".$ponto->mes) }}' class="ml-2 btn btn-secondary {{$ponto->hasAutomatico == 1 ? 'disabled' : ''}}">PDF</a>
                                    <a href='{{ url("funcionario/frequencia/".$ponto->funcionario_id."/edit/".$ponto->ano."/".$ponto->mes) }}' class="ml-2 btn btn-warning">Editar</a>
                                </td>
                                <td class='text-center'>
                                    @if($ponto->hasAutomatico == 0)
                                        <div data-toggle="tooltip" data-placement="left" title="Os registros de ponto não contém irregularidades.">
                                            <i class="material-icons icon-ponto icon-ponto-success">check_circle</i>
                                        </div>
                                    @else
                                        <div data-toggle="tooltip" data-placement="left" title="Os registros de ponto contém registros automáticos, favor verificá-los.">
                                            <i class="material-icons icon-ponto icon-ponto-danger">error</i>
                                        </div>
                                    @endif
                                </td>
                            <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="{{Module::asset('funcionario:js/views/funcionario/index.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection