<?php

$moduleInfo = [
    'icon' => 'today',
    'name' => config('calendario.name')
];

$menu = [
    ['icon' => 'calendar_view_day', 'tool' => 'Visão Geral', 'route' => route('calendario.index')],
    ['icon' => 'calendar_today', 'tool' => 'Agendas', 'route' => route('agendas.index')]
];

?>

@extends('template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':css/app.css')}}">
@endsection

@section('js')
    @parent
    <script src="{{Module::asset(config('calendario.id').':js/app.js')}}"></script>
@endsection
