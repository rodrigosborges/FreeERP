<?php 
    $moduleInfo = [
        'icon' => 'people',
        'name' => 'Protocolos',
    ];
    $menu = [
        ['icon' => 'people', 'tool' => 'Protocolo', 'route' => url('protocolos/protocolos')],
    ];
?>

@extends('template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{Module::asset('Protocolos:css/style.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- baixar -->
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
    <script src="{{Module::asset('Protocolos:js/bibliotecas/jquery.mask.min.js')}}"></script>
    <!-- <script src="{{Module::asset('Protocolos:js/bibliotecas/jquery-ui.min.js')}}"></script> -->
    <script src="{{Module::asset('Protocolos:js/bibliotecas/jquery.min.js')}}"></script>
    <script src="{{Module::asset('Protocolos:js/bibliotecas/jquery-ui.min.js')}}"></script>
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <script src="{{Module::asset('Protocolos:js/bibliotecas/bootstrap.min.js')}}"></script>
    <script src="{{Module::asset('Protocolos:js/bibliotecas/jquery.validate.min.js')}}"></script>
    <script src="{{Module::asset('Protocolos:js/bibliotecas/localization/messages_pt_BR.min.js')}}"></script>
    <script src="{{Module::asset('Protocolos:js/main.js')}}"></script>
    <script>var main_url="{{url('')}}"</script>
    @yield('script')
@endsection