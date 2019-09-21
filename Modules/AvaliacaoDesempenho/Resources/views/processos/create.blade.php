@extends('template')

@section('css')
<link href="{{Module::asset('avaliacaodesempenho:css/processos/create.css')}}" rel="stylesheet">
@endsection

@section('content')
    @include('avaliacaodesempenho::processos._form')
@endsection

@section('scripts')
@endsection