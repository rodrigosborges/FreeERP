@extends('avaliacaodesempenho::template')

@section('style')
<link href="{{Module::asset('avaliacaodesempenho:css/processos/create.css')}}" rel="stylesheet">
@endsection

@section('container')
    @include('avaliacaodesempenho::processos._form')
@endsection

@section('scripts')
<script src="{{Module::asset('avaliacaodesempenho:js/plugins/jquery-mask.js')}}"></script>
<script src="{{Module::asset('avaliacaodesempenho:js/avaliacoes/_masks.js')}}"></script>
<script src="{{Module::asset('avaliacaodesempenho:js/processos/_processo-validation.js')}}"></script>
@endsection