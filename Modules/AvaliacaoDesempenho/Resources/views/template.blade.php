@extends('template')

@section('css')
<link rel='stylesheet' href="{{Module::asset('avaliacaodesempenho:css/plugins/datatable.min.css')}}" />
<link rel='stylesheet' href="{{Module::asset('avaliacaodesempenho:css/plugins/datatable-bootstrap.min.css')}}" />

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
<script>
    $(document).ready(function () {
        $(window).keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault()
                return false;
            }
        })
    })
</script>
@yield('scripts')
@endsection