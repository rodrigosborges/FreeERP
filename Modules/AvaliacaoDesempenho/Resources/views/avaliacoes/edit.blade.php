@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/avaliacoes/create.css')}}" rel="stylesheet">
@endsection

@section('container')
    @include('avaliacaodesempenho::avaliacoes._form')
@endsection

@section('scripts')
@endsection