@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/setores/create.css')}}" rel="stylesheet">
@endsection

@section('container')
    @include('avaliacaodesempenho::setores._form')
@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/setores/_setor-validation.js')}}"></script>
@endsection