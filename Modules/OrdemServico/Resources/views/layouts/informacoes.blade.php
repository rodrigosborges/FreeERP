<?php
$moduleInfo = [
    'icon' => 'settings',
    'name' => 'Ordem de Serviço',
];
if (Gate::allows('administrador', Auth::user())) {
    $menu = [
        ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => route('modulo.os.index')],
        ['icon' => 'add_box', 'tool' => 'OS concluidas', 'route' => route('modulo.os.finalizadas')],
        ['icon' => 'add_box', 'tool' => 'Adicionar Status', 'route' => route('modulo.status.create')],
        ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => '/logout'],
    ];
} elseif (Gate::allows('operador', Auth::user())) {
    $menu = [
        ['icon' => 'add_box', 'tool' => 'Home', 'route' => route('modulo.tecnico.painel.index')],
        ['icon' => 'add_box', 'tool' => 'Minhas OS', 'route' => route('modulo.tecnico.painel.minhasOs',Auth::user())],
        ['icon' => 'add_box', 'tool' => 'Ordens Disponíveis', 'route' => route('modulo.tecnico.painel.ordens_disponiveis')],
        ['icon' => 'add_box', 'tool' => 'Problemas', 'route' => route('modulo.tecnico.painel.problemas')],
        ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => '/logout'],
    ];
} else {
    $menu = [
        ['icon' => 'person', 'tool' => 'Logar', 'route' => '/'],
    ];
}
?>
@extends('template')