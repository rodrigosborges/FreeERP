@extends('avaliacaodesempenho::template')

@section('style')
<!-- <link href="{{Module::asset('avaliacaodesempenho:css/plugins/bootstrap-select.min.css')}}" rel="stylesheet"> -->
<link href="{{Module::asset('avaliacaodesempenho:css/plugins/easyautocomplete.min.css')}}" rel="stylesheet">
<link href="{{Module::asset('avaliacaodesempenho:css/plugins/easyautocomplete-themes.min.css')}}" rel="stylesheet">
<link href="{{Module::asset('avaliacaodesempenho:css/avaliacoes/create.css')}}" rel="stylesheet">
@endsection

@section('container')
    @include('avaliacaodesempenho::avaliacoes._form')
@endsection

@section('scripts')
<!-- <script src="{{Module::asset('avaliacaodesempenho:js/plugins/bootstrap-select.min.js')}}"></script> -->
<script src="{{Module::asset('avaliacaodesempenho:js/plugins/easyautocomplete.min.js')}}"></script>
<script src="{{Module::asset('avaliacaodesempenho:js/avaliacoes/_select-search.js')}}"></script>
<script src="{{Module::asset('avaliacaodesempenho:js/plugins/jquery-mask.js')}}"></script>
<script src="{{Module::asset('avaliacaodesempenho:js/avaliacoes/_masks.js')}}"></script>
@endsection