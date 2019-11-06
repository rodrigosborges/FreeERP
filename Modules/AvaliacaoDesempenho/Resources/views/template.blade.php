@extends('template')

@section('css')
<link rel='stylesheet' href="{{Module::asset('avaliacaodesempenho:css/plugins/datatable.min.css')}}"/>

@yield('style')
@endsection

@section('content')

    <div class="container">
        @yield('container')
    </div>

@endsection

@section('js')
<script src="{{Module::asset('avaliacaodesempenho:js/plugins/bootbox.min.js')}}"></script>
<script src="{{Module::asset('avaliacaodesempenho:js/plugins/datatable.min.js')}}"></script>
@yield('scripts')
@endsection