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
                            <th>Ações</th>
                            <th width="1px">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['pontos'] as $ponto)
                            <tr>
                                <td>{{ucfirst($ponto->nome_mes)}}</td>
                                <td>{{$ponto->ano}}</td>
                                <td></td>
                                <td class='text-center'>
                                    @if(true)
                                        <div data-toggle="tooltip" data-placement="left" title="Os registros">
                                            <i class="material-icons icon-ponto icon-ponto-success">check_circle</i>
                                        </div>
                                    @else
                                        <div data-toggle="tooltip" data-placement="left" title="Tooltip na parte superior">
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
@endsection