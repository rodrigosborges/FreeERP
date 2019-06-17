<?php

$moduleInfo = [
    'icon' => 'calendar_today',
    'name' => config('calendario.name')
];

$menu = [
    ['icon' => 'people', 'tool' => 'Criar Agenda', 'route' => route('agenda.criar')],
];

?>

@extends('template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':css/app.css')}}">
@endsection

@section('js')
    <script src="{{Module::asset(config('calendario.id').':js/app.js')}}"></script>
@endsection