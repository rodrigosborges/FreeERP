    
@extends('template')


<?php
    $menu = [
        ['icon' => 'person', 'tool' => 'Usuário', 'route' => '/usuario'],
        ['icon' => 'add_circle', 'tool' => 'Módulo', 'route' => '/modulo'],
        ['icon' => 'contacts', 'tool' => 'Papel', 'route' => '/papel'],
    ];
    $moduleInfo = [
        'icon' => 'person',
        'name' => 'Usuario'
    ];
?>
