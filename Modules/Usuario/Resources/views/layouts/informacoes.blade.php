    
@extends('template')



<?php
    $menu = [
        ['icon' => 'person', 'tool' => 'Usuário', 'route' => url('/usuario')],
        ['icon' => 'add_circle', 'tool' => 'Módulo', 'route' => url('/modulo')],
        ['icon' => 'contacts', 'tool' => 'Papel', 'route' => url('/papel')],
        ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => url('/logout')],
    ];
    $moduleInfo = [
        'icon' => 'person',
        'name' => 'Usuario'
    ];
?>
