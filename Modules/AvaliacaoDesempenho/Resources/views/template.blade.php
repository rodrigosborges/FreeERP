@extends('template')

@section('css')

@yield('style')
@endsection

@section('content')

    <div class="container">
        @yield('container')
    </div>

@endsection

@section('js')
<script src="{{Module::asset('avaliacaodesempenho:js/plugins/bootbox.min.js')}}"></script>
@yield('scripts')
@endsection