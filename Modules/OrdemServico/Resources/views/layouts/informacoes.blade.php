<?php 
    $moduleInfo = [
        'icon' => 'settings',
        'name' => 'Ordem de Serviço',
    ];
    $menu = [
        ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => url('ordemservico/os')],
        ['icon' => 'add_box', 'tool' => 'Gerenciar técnico', 'route' => url('ordemservico/tecnico')],
    ];
?>


@extends('template')

