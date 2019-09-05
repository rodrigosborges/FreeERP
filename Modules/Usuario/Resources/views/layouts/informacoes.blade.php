    
@extends('template')


<?php
    $menu = [
        ['icon' => 'person', 'tool' => 'Usuário', 'route' => '/usuario'],
        ['icon' => 'add_circle', 'tool' => 'Módulo', 'route' => '/modulo'],
        ['icon' => 'contacts', 'tool' => 'Papel', 'route' => '/papel'],
        ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => '/logout'],
    ];
    $moduleInfo = [
        'icon' => 'person',
        'name' => 'Usuario'
    ];
?>
