@extends('funcionario::template')

@section('title')
    {{$data['title']}}
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{Module::asset('funcionario:css/frequencia.css')}}">
@endsection

@section('body')

    <form id="form" method="POST" action="{{ url('/funcionario/frequencia/'.$data['funcionario']->id.'/horasdiarias') }}">
        @csrf
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Horas diárias</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">query_builder</i>
                            </span>
                        </div>
                        <input id="horas_diarias" class="form-control" type="number" name="horas_diarias" min=1 max=12 value="{{$data['funcionario']->horas_diarias}}"/>    
                    </div>
                    <span class="errors"> {{ $errors->first('horas_diarias') }} </span>
                </div>
            </div>
            <div class="col-md-2 pt-4">
                <button type="submit" class="btn btn-info mt-2">Alterar horas diárias</button>
            </div>
        </div>
    </form>

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
                                    <a href='{{ url("funcionario/frequencia/".$data["funcionario"]->id."/xls/".$ponto->ano."/".$ponto->mes) }}' class="btn btn-primary {{$ponto->hasAutomatico == 1 ? 'disabled' : ''}}">XLS</a>
                                    <a target="__blank" href='{{ url("funcionario/frequencia/".$data["funcionario"]->id."/pdf/".$ponto->ano."/".$ponto->mes) }}' class="ml-2 btn btn-secondary {{$ponto->hasAutomatico == 1 ? 'disabled' : ''}}">PDF</a>
                                    <a href='{{ url("funcionario/frequencia/".$data["funcionario"]->id."/edit/".$ponto->ano."/".$ponto->mes) }}' class="ml-2 btn btn-warning">Editar</a>
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
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection