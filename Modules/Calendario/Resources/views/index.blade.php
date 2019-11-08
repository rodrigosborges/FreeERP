@extends('calendario::template/index')

@section('title', 'Calendário')

@section('content')
    @parent
    @if($agendas->isNotEmpty() || $agendas_setor->isNotEmpty())
        <div id="agendas">
            <div class="card">
                <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#filtrar">
                        <i class="material-icons">filter_list</i> Agendas e eventos
                    </a>
                </div>
                <div id="filtrar" class="collapse" data-parent="#agendas">
                    <div class="card-body">
                        @foreach($agendas as $agenda)
                            <div class="agenda custom-control custom-checkbox">
                                <input type="checkbox" id="agenda{{$agenda->id}}" class="custom-control-input"
                                       value="{{$agenda->id}}" name="agenda{{$agenda->id}}" checked>
                                <label class="custom-control-label" for="agenda{{$agenda->id}}"
                                       style="padding-bottom: 3px; border-bottom: 3px solid #{{$agenda->cor->codigo}}">{{$agenda->titulo}}
                                    ({{$agenda->eventos->count()}})
                                </label>
                            </div>
                        @endforeach
                        @foreach($agendas_setor as $agenda)
                            <div class="agenda custom-control custom-checkbox">
                                <input type="checkbox" id="agenda{{$agenda->id}}" class="custom-control-input"
                                       value="{{$agenda->id}}" name="agenda{{$agenda->id}}" checked>
                                <label class="custom-control-label" for="agenda{{$agenda->id}}"
                                       style="padding-bottom: 3px; border-bottom: 3px solid #{{$agenda->cor->codigo}}">
                                    {{$agenda->titulo}}
                                    ({{$agenda->eventos->count()}})
                                    <span class="badge badge-secondary" data-toggle="tooltip" title="Agenda de {{$agenda->funcionario->nome}}">{{$setor}}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="calendario"></div>
@endsection

@section('css')
    @parent
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/daygrid/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/timegrid/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/list/main.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/bootstrap/main.min.css')}}">
    <style type="text/css">
        .fc-body {
            cursor: cell;
        }

        .fc-event-container {
            cursor: pointer;
        }

        #agendas {
            margin-bottom: 10px;
        }

        .agenda {
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            margin-right: 15px;
            margin-bottom: 5px;
            max-width: 300px;
        }

        .agenda label {
            margin: 0;
        }

        .card-link {
            display: inline-flex;
            vertical-align: middle;
        }
    </style>
@endsection

@section('js')
    @parent
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/daygrid/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/interaction/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/timegrid/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/list/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/bootstrap/main.min.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/locales/pt-br.js')}}"></script>

    <script type="text/javascript">
        var filtroAgenda = function (agenda) {
            if ($('#' + agenda).prop('checked')) {
                $('.' + agenda).show();
            } else {
                $('.' + agenda).hide();
            }
        };

        $(function () {
            var agendas = '{{ $agendas }}';

            var calendarEl = document.getElementById('calendario');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',
                height: 'parent',
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap'],
                themeSystem: 'bootstrap',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                events: '{{route('eventos.index')}}',
                eventRender: function (info) {
                    var agenda = info.event.extendedProps.agenda;
                    var descricao = info.event.extendedProps.descricao;
                    var usuario = info.event.extendedProps.usuario;
                    var nome = info.event.extendedProps.nome;
                    var duplicar = '{{route('eventos.duplicar', 'id')}}';
                    duplicar = duplicar.replace('id', info.event.id);

                    if (descricao != null) {
                        $(info.el).tooltip({
                            'title': descricao
                        });
                        $(info.el).find('.fc-title').append('<i style="font-size: inherit; line-height: inherit" class="material-icons float-right">info</i>');
                    }

                    if('{{auth()->id()}}' == usuario) {
                        $(info.el).find('.fc-title').append('<a href="' + duplicar + '" class="float-right text-white"><i style="font-size: inherit; line-height: inherit" class="material-icons">file_copy</i></a>');
                    } else {
                        $(info.el).css('cursor', 'default');
                        $(info.el).tooltip({
                            'title': 'Criado por ' + nome
                        });
                        $(info.el).find('.fc-title').append('<i style="font-size: inherit; line-height: inherit" class="material-icons float-right">info</i>');
                    }

                    if(info.event.end){
                        if(info.event.end.getTime() < Date.now()){
                            $(info.el).css('text-decoration', 'line-through');
                        }
                    } else {
                        if(info.event.start.getTime() < Date.now()){
                            $(info.el).css('text-decoration', 'line-through');
                        }
                    }
                },
                dateClick: function (info) {
                    if (Object.keys(agendas).length <= 2) {
                        bootbox.confirm({
                            title: "Nenhuma agenda cadastrada",
                            message: "Para criar eventos você deve possui ao menos uma agenda para vinculá-los. Deseja criar uma agenda?",
                            locale: 'br',
                            callback: function (result) {
                                if (result == true) {
                                    window.location.href = '{{route('agendas.criar')}}';
                                }
                            }
                        });
                    } else {
                        localStorage.setItem('cal-data', info.dateStr);
                        var url = '{{route('eventos.criar')}}';
                        window.location.href = url;
                    }
                },
                eventClick: function (info) {
                    var usuario = info.event.extendedProps.usuario;
                    if('{{auth()->id()}}' != usuario){
                        return null;
                    }
                    var url = '{{route('eventos.editar', 'id')}}';
                    url = url.replace('id', info.event.id);
                    window.location.href = url;
                }
            });

            calendar.render();

            $('[id^="agenda"].custom-control-input').on('click', function (e) {
                e.stopPropagation();
                filtroAgenda(e.target.id);
            });
        });
    </script>
@endsection
