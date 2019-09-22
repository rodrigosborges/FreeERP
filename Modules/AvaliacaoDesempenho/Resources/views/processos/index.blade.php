@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/processos/index.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">

    <div class="card-header">
        <div class="row">
            <h3>Processos</h3>
            <span>
                <a href="/tcc/public/avaliacaodesempenho/processos/create" class="btn btn-primary">Adicionar</a>
            </span>
        </div>
    </div>

    <div class="card-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div id="ProcessoTable" class="table-responsive"></div>

    </div>

    <div class="card-footer"></div>

</div>

@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/processos/_main.js')}}"></script>
@endsection