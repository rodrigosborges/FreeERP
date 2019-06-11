<?php

$moduleInfo = [
    'icon' => 'calendar_today',
    'name' => config('calendario.name')
];

$menu = [
    ['icon' => 'people', 'tool' => 'Funcionario', 'route' => url('#')],
    ['icon' => 'work', 'tool' => 'Cargo', 'route' => url('#')],
];
?>

@extends('template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':css/app.css')}}">
    @yield('style')
@endsection

@section('js')
    <script src="{{Module::asset(config('calendario.id').':js/app.js')}}"></script>
    @yield('script')
@endsection