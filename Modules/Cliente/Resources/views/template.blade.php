<?php 
    $moduleInfo = [
        'icon' => 'people',
        'name' => 'Cliente',
    ];
    $menu = [
        ['icon' => 'people', 'tool' => 'Cliente', 'route' => url('cliente/cliente')],
        // ['icon' => 'work', 'tool' => 'Cargo', 'route' => url('funcionario/cargo')],
    ];
?>

@extends('template')

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{Module::asset('cliente:css/style.css')}}"> --}}
    @yield('style')
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>@yield('title')</h5>
            </div>
            <div class="card-body">
                @yield('body')
            </div>
            @if (trim($__env->yieldContent('footer')))
                <div class="card-footer">
                    @yield('footer')
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="{{Module::asset('cliente:js/bibliotecas/jquery.mask.min.js')}}"></script>
    <script src="{{Module::asset('cliente:js/bibliotecas/jquery.validate.min.js')}}"></script>
    <script src="{{Module::asset('cliente:js/bibliotecas/localization/messages_pt_BR.min.js')}}"></script>
    <script src="{{Module::asset('cliente:js/main.js')}}"></script>
    <script>var main_url="{{url('')}}"</script>
    @yield('script')
@endsection