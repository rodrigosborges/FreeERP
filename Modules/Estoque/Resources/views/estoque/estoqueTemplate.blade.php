<?php
$moduleInfo = [
    'icon' => 'store',
    'name' => 'Estoque',
];
$menu = [
    ['icon' => 'shopping_basket', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
    ['icon' => 'format_align_justify', 'tool' => 'Categoria', 'route' => url('estoque/produto/categoria')],
    ['icon' => 'store', 'tool' =>  'Estoque', 'route' => url('estoque')],
];
?>

@extends('template')



@section('content')
<div class="container">

    <div class="card text-center">

        <div class="card-header">
            <h5 style="font-size:25px;">@yield('title')</h5>

        </div>
        <ul class="nav justify-content-center" style="background-color: rgb(100,149,237); margin-bottom:5px">
            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoque/notificacoes')}}">Notificações <span class="badge badge-warning">{{isset($notificacoes) && $notificacoes > 0 ? $notificacoes : ''}}</span></a>
            </li>


            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoque')}}">Itens em estoque</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoque/tipo-unidade')}}">Gerenciar Unidades</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white " href="{{url('estoque/movimentacao')}}">Movimentação de estoque</a>
            </li>
        
            <li class="nav-item ">
                <div class="dropdown">
                    <a class="nav-link text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Relatorios</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">Saída de produtos</button>
                            <button class="dropdown-item" type="button">Movimentação de produtos</button>
                            <button class="dropdown-item" type="button">Custo</button>
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