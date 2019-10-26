<?php
$moduleInfo = [
    'icon' => 'settings',
    'name' => 'Ordem de Serviço',
];
$menu = [
    ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => route('modulo.os.index')],
    ['icon' => 'add_box', 'tool' => 'Painel de ordens', 'route' => route('modulo.tecnico.painel.index')],
    ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => '/logout'],
];
?>
@extends('template')