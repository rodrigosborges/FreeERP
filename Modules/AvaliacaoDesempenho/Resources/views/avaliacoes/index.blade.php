@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/avaliacoes/index.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">

    <div class="card-header">
        <div class="row header">
            <h3>Avaliações</h3>
            <span>
                <a href="{{ url('avaliacaodesempenho/avaliacao/create') }}" class="btn btn-primary">Adicionar</a>
            </span>
        </div>

        <hr>

        <div class="search-row">
            <div class="row label">
                <i class="material-icons md-36">search</i>
                <h3> Pequisar</h3>
            </div>
             @include('avaliacaodesempenho::avaliacoes._search')
        </div>
    </div>

    <div class="card-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div id="AvaliacaoTable"></div>
    </div>
    
</div>

@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/avaliacoes/index.js')}}"></script>
@endsection