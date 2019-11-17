@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/questoes/create.css')}}" rel="stylesheet">
@endsection

@section('container')
    @include('avaliacaodesempenho::questoes._form')
@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/questoes/_questao-validation.js')}}"></script>
@endsection