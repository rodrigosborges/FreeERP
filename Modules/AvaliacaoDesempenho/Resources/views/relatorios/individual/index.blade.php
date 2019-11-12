@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/relatorios/individual/index.css')}}" rel="stylesheet">
@endsection

@section('container')

<div class="card">

    <div class="card-header">

        <div class="search-row">
            
            <div class="row label">
                <i class="material-icons md-36">search</i>
                <h3> Pequisar</h3>
            </div>

             @include('avaliacaodesempenho::relatorios.individual._search-individual')

        </div>

    </div>

    <div class="card-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div id="RelatorioIndividualListar"></div>

        <p class='initial-info text-center'>Busque um processo em andamento ou finalizado e selecione uma avaliação</p>
    </div>
    
</div>

@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/relatorios/_individual.js')}}"></script>
@endsection