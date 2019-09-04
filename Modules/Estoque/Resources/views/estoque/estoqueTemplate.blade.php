<?php
$moduleInfo = [
    'icon' => 'store',
    'name' => 'Estoque',
];
$menu = [
    ['icon' => 'shopping_basket', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
    ['icon' => 'format_align_justify', 'tool' => 'Categoria', 'route' => url('/estoque/produto/categoria')],
    ['icon' => 'store', 'tool' => 'Estoque', 'route' => url('estoque')],
];
?>

@extends('template')

@section('css')
<link rel="stylesheet" type="text/css" href="{{Module::asset('funcionario:css/style.css')}}">
@yield('style')
@endsection

@section('content')
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h5>@yield('title')</h5>
        </div>
        <div class="card-body">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link  active" href="#">Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">Relatorios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info " href="{{url('estoque/tipo-unidade')}}">Gerenciar Unidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info " href="#">Movimentação de estoque</a>
                </li>
            </ul>
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
