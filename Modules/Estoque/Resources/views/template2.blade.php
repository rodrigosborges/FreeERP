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



@section('content')
<div class="container">

    <div class="card text-center">

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