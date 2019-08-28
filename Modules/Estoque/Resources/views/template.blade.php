<?php 
    $moduleInfo = [
        'icon' => 'store',
        'name' => 'Estoque',
    ];
    $menu = [
        ['icon' => 'shopping_basket', 'tool' => 'Produto', 'route' => url('/estoque/produto')],
        ['icon' => 'format_align_justify', 'tool' => 'Categoria', 'route' => url('/estoque/produto/categoria')],
    ];
?>

@extends('template')