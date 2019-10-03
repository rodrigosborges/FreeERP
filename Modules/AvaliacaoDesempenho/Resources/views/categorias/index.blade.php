@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/categorias/index.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">

    <div class="card-header">
        <div class="row">
            <h3>Categorias</h3>
            <span>
                <a href="{{ url('avaliacaodesempenho/categoria/create') }}" class="btn btn-primary">Adicionar</a>
            </span>
        </div>
    </div>

    <div class="card-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div id="CategoriaTable"></div>
    </div>

    <div class="card-footer"></div>
    
</div>

@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/categorias/_main.js')}}"></script>
@endsection