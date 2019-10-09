<?php 
    $moduleInfo = [
        'icon' => 'settings',
        'name' => 'Ordem de Serviço',
    ];
    $menu = [
        ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => route('modulo.os.index')],
    ];
?>


@extends('template')

