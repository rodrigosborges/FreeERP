<?php
$moduleInfo = [
    'icon' => 'settings',
    'name' => 'Ordem de Serviço',
];
if (Gate::allows('administrador', Auth::user())) {
    $menu = [
        ['icon' => 'label', 'tool' => 'Gerenciar OS', 'route' => route('modulo.os.index')],
        ['icon' => 'label', 'tool' => 'OS concluidas', 'route' => route('modulo.os.finalizadas')],
        ['icon' => 'label', 'tool' => 'Adicionar Status', 'route' => route('modulo.status.create')],
        ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => '/logout'],
    ];
} elseif (Gate::allows('operador', Auth::user())) {
    $menu = [
        ['icon' => 'label', 'tool' => 'Home', 'route' => route('modulo.tecnico.painel.index')],
        ['icon' => 'label', 'tool' => 'Minhas OS', 'route' => route('modulo.tecnico.painel.minhasOs',Auth::user())],
        ['icon' => 'label', 'tool' => 'Ordens Disponíveis', 'route' => route('modulo.tecnico.painel.ordens_disponiveis')],
        ['icon' => 'label', 'tool' => 'Problemas', 'route' => route('modulo.tecnico.painel.problemas')],
        ['icon' => 'power_settings_new', 'tool' => 'Sair', 'route' => '/logout'],
    ];
} else {
    $menu = [
        ['icon' => 'person', 'tool' => 'Logar', 'route' => '/'],
    ];
}
?>
@extends('template')