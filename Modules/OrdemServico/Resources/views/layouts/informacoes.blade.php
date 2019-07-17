<?php 
    $moduleInfo = [
        'icon' => 'settings',
        'name' => 'Ordem de Serviço',
    ];
    $menu = [
        ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => route('modulo.os.index')],
        ['icon' => 'add_box', 'tool' => 'Gerenciar Técnico', 'route' => route('modulo.tecnico.index')],
        ['icon' => 'add_box', 'tool' => 'Gerenciar Gerente', 'route' => route('modulo.gerente.index')],
        ['icon' => 'add_box', 'tool' => 'Gerenciar Solicitante', 'route' => route('modulo.solicitante.index')],
        ['icon' => 'add_box', 'tool' => 'Listar Problema', 'route' => route('modulo.problema.index')],
    ];
?>


@extends('template')

