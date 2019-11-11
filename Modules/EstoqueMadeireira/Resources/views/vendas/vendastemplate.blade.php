<?php

$moduleInfo = [
    'icon' => 'store',
    'name' => 'Estoque Madeireira',
];

$menu = [
    ['icon' => 'shopping_basket', 'tool' => 'Produtos', 'route' => '/estoquemadeireira/produtos'],
    ['icon' => 'class', 'tool' => 'Categorias', 'route' => '/estoquemadeireira/produtos/categorias'],
    ['icon' => 'account_circle', 'tool' => 'Fornecedores', 'route' => '/estoquemadeireira/produtos/fornecedores'],
    ['icon' => 'attach_money', 'tool' => 'Vendas', 'route' => '/estoquemadeireira/vendas'],
    ['icon' => 'store', 'tool' => 'Estoque', 'route' => '/estoquemadeireira'],

];
$this->template = [
    'moduleInfo' => $moduleInfo,
    'menu' => $menu
];

?>



<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

@extends('template')



@section('content')
<div class="container">

    <div class="card">

        <div class="card-header text-left">
            <h4 style="font-size:25px;">@yield('title')</h4>

        </div>
        <ul class="nav justify-content-center" style="background-color: rgb(100,149,237); margin-bottom:5px">

            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoquemadeireira/vendas/clientes')}}">Clientes</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoquemadeireira/vendas')}}">Vendas</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoquemadeireira/movimentacao')}}">Movimentação</a>
            </li>
        
            <li class="nav-item ">
                <div class="dropdown">
                    <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Relatorios</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a class="dropdown-item" href="{{url('/estoquemadeireira/relatorio/movimentacao')}}">Movimentação</a>
                        </div>
                </div>
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
