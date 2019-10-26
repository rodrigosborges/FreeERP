<?php
$moduleInfo = [
    'icon' => 'settings',
    'name' => 'Ordem de Serviço',
];
if(Auth::user()){
$menu = [
    ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => route('modulo.os.index')],
    ['icon' => 'add_box', 'tool' => 'Painel de ordens', 'route' => route('modulo.tecnico.painel.index')],
    ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => '/logout'],
];
}
else{
    $menu = [
        ['icon' => 'person', 'tool' => 'Logar', 'route' => '/'],
    ];
}
?>
@extends('template')