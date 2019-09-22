@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/processos/create.css')}}" rel="stylesheet">
@endsection

@section('container')
    @include('avaliacaodesempenho::processos._form')
@endsection

@section('scripts')
@endsection