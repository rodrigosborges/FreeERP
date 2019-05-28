<?php 
    $moduleInfo = [
        'icon' => 'people',
        'name' => 'Funcionário',
    ];

    $menu = [
        ['icon' => 'people', 'tool' => 'Funcionario', 'route' => url('funcionario/funcionario')],
        ['icon' => 'work', 'tool' => 'Cargo', 'route' => url('funcionario/cargo')],
    ];
?>

@extends('template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{Module::asset('funcionario:css/style.css')}}">
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
    <script src="{{Module::asset('funcionario:js/bibliotecas/jquery.mask.min.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/bibliotecas/jquery.validate.min.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/bibliotecas/localization/messages_pt_BR.min.js')}}"></script>
    <script src="{{Module::asset('funcionario:js/main.js')}}"></script>
    <script>var main_url="{{url('')}}"</script>
    @yield('script')
@endsection
