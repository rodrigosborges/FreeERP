@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/categorias/create.css')}}" rel="stylesheet">
@endsection

@section('container')
    @include('avaliacaodesempenho::categorias._form')
@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/categorias/_categoria-validation.js')}}"></script>
@endsection