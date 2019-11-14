<?php 
    $moduleInfo = [
        'icon' => 'list_alt',
        'name' => 'Protocolos',
    ];

    if(Auth::check()){
        $menu = [
            ['icon' => 'list_alt', 'tool' => 'Protocolo', 'route' => url('protocolos/protocolos')],
            ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => url('protocolos/protocolos/logout')],
        ];
    }
    else{
        $menu = [
            ['icon' => 'list_alt', 'tool' => 'Protocolo', 'route' => url('protocolos/protocolos')],
        ];
    }

    $login = [
        'route' => url('protocolos/protocolos/login')
    ];

    $name = [
        'tool'  => Auth::check() ? Auth::user()->apelido : " "
    ]
?>

@extends('template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{Module::asset('Protocolos:css/style.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- baixar -->
    @yield('style')
@endsection

@section('content')
    @yield('relatorio')
    <div class="container">
        <div class="card d-flex">
            <div class="card-header d-flex justify-content-center">
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