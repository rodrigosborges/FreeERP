<?php 
    $moduleInfo = [
        'icon' => 'settings',
        'name' => 'Ordem de Serviço',
    ];
    $menu = [
        ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => 'os'],
        ['icon' => 'add_box', 'tool' => 'Gerenciar técnico', 'route' => 'tecnico'],
    ];
?>


@extends('template')

