@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/categorias/index.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">

    <div class="card-header">
        <div class="row header">
            <h3>Categorias</h3>
            <span>
                <a href="{{ url('avaliacaodesempenho/categoria/create') }}" class="btn btn-primary">Adicionar</a>
            </span>
        </div>

        <hr>

        <div class="search-row">
            <div class="row label">
                <i class="material-icons md-36">search</i>
                <h3> Pequisar</h3>
            </div>
             @include('avaliacaodesempenho::categorias._search')
        </div>
    </div>

    <div class="card-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div id="CategoriaTable"></div>
    </div>
    
</div>

@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/categorias/_main.js')}}"></script>
@endsection