    
@extends('template')


<?php
    $menu = [
        ['icon' => 'person', 'tool' => 'Usuário', 'route' => '/usuario'],
        ['icon' => 'add_circle', 'tool' => 'Módulo', 'route' => '/modulo'],
        ['icon' => 'add_circle', 'tool' => 'Papel', 'route' => '/papel'],
    ];
    $moduleInfo = [
        'icon' => 'person',
        'name' => 'Usuario'
    ];
?>
