<?php
$moduleInfo = [
    'icon' => 'store',
    'name' => 'Estoque',
];
$menu = [
    ['icon' => 'shopping_basket', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
    ['icon' => 'format_align_justify', 'tool' => 'Categoria', 'route' => url('estoque/produto/categoria')],
    ['icon' => 'store', 'tool' => 'Estoque', 'route' => url('estoque')],
];
?>

@extends('template')



@section('content')
<div class="container">

    <div class="card text-center">

        <div class="card-header">
            <h5 style="font-size:25px;">@yield('title')</h5>

        </div>
        <ul class="nav justify-content-center bg-secondary" style="margin-bottom:5px">
            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoque')}}">Itens em estoque</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoque/tipo-unidade')}}">Gerenciar Unidades</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white " href="#">Movimentação de estoque</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white" href="#">Relatorios</a>
            </li>
        </ul>
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