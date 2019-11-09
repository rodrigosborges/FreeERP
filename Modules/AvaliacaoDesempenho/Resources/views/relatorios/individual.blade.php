@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/relatorios/index.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">

    <div class="card-header">

        <div class="search-row">
            
            <div class="row label">
                <i class="material-icons md-36">search</i>
                <h3> Pequisar</h3>
            </div>

             @include('avaliacaodesempenho::relatorios._search-individual')

        </div>

    </div>

    <div class="card-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div id="RelatorioIndividualListar"></div>
    </div>
    
</div>

@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/relatorios/_individual.js')}}"></script>
@endsection