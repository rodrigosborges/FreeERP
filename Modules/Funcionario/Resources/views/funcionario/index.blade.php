@extends('funcionario::template')

@section('title','Lista de funcionários')

@section('body')

    <div class="row">
        <div class="col-md-4">
            <form id="form">
                <div class="form-group">
                    <input id="search-input" class="form-control" type="text" name="pesquisa" />
                </div>
            </form>
        </div>
        <div class="col-md-2 pl-0">
            <div class="form-group">
                <i id="search-button" class="btn btn-info material-icons">search</i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <a class="btn btn-success" href="{{ url('funcionario/funcionario/create') }}">Novo Funcionário</a>
            </div>
        </div>
    </div>
    
    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="ativos-tab" data-toggle="tab" href="#ativos" role="tab" aria-controls="ativos" aria-selected="true">Ativos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel"></div>
        <div class="tab-pane fade" id="inativos" role="tabpanel"></div>
    </div>
@endsection

@section('script')
    <script src="{{Module::asset('funcionario:js/views/funcionario/index.js')}}"></script>
@endsection