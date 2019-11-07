<?php

$moduleInfo = [
    'icon' => 'today',
    'name' => config('calendario.name')
];

$menu = [
    ['icon' => 'calendar_view_day', 'tool' => 'Visão Geral', 'route' => route('calendario.index')],
    ['icon' => 'calendar_today', 'tool' => 'Minhas Agendas', 'route' => route('agendas.index')],
    ['icon' => 'people', 'tool' => 'Convites', 'route' => route('convites.index')],
    ['icon' => 'share', 'tool' => 'Compartilhamentos', 'route' => route('compartilhamentos.index')],
];

?>

@extends('template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <style type="text/css">
        h2 {
            margin-bottom: 20px;
        }

        #sidebar a.active {
            background-color: #f3f6f7;
            color: #5f6368;
        }

        .trashed {
            background-color: #f9d6d5 !important;
            display: none;
        }

        .controles {
            margin-bottom: 10px;
            color: #ffffff;
        }

        .acoes button, .acoes a {
            float: right;
            margin-left: 5px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{Module::asset(config('calendario.id').':bootbox.all.min.js')}}"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script type="text/javascript">
        var userID = '{{auth()->id()}}';
        $(function () {
            var notificacao = new Audio('{{Module::asset(config('calendario.id').':audio/notificacao.ogg')}}');

            function notificar(notification) {
                $.when(
                    bootbox.alert({
                        title: notification.title,
                        message: notification.message,
                        className: 'animated heartBeat'
                    })
                        .removeClass('fade')
                        .find('.modal-dialog')
                        .addClass('modal-dialog-centered')
                ).done(function () {
                    notificacao.play();
                });
            }

            var pusher = new Pusher('6ca8d531d809db01d827', {
                cluster: 'us2',
                forceTLS: true,
                authEndpoint: '/broadcasting/auth',
                auth: {
                    headers: {
                        'X-CSRF-Token': '{{csrf_token()}}'
                    }
                }
            });

            var channel = pusher.subscribe('private-Modules.Calendario.Entities.User.' + userID);
            channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function (data) {
                if(data.type == 'Modules\\Calendario\\Notifications\\NotificarEventoProximo'){
                    notificar(data);
                }
            });

            $.when(
                $('#sidebar a.nav-link span').each(function () {
                    switch ($(this).text().trim()) {
                        case 'Visão Geral':
                            $(this).parent('a').addClass('visao-geral');
                            break;
                        case 'Minhas Agendas':
                            $(this).parent('a').addClass('agendas');
                            break;
                        case 'Convites':
                            $(this).parent('a').addClass('convites');
                            break;
                        case 'Compartilhamentos':
                            $(this).parent('a').addClass('compartilhamentos');
                            break;
                    }
                }))
                .done(function () {
                    switch ('{{ \Illuminate\Support\Facades\Route::currentRouteName() }}'.trim()) {
                        case 'calendario.index':
                            $('.visao-geral').addClass('active');
                            break;
                        case 'agendas.index':
                        case 'agendas.editar':
                        case 'agendas.criar':
                        case 'agendas.eventos.index':
                        case 'eventos.criar':
                        case 'eventos.editar':
                            $('.agendas').addClass('active');
                            break;
                        case 'convites.index':
                            $('.convites').addClass('active');
                            break;
                        case 'compartilhamentos.index':
                            $('.compartilhamentos').addClass('active');
                            break;
                    }
                });
        });
    </script>
@endsection
