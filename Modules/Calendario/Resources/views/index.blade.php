@extends('calendario::template/index')

@section('title', 'Calendário')

@section('content')
    @parent
    @include('calendario::eventos/criar')

    @if($agendas->isNotEmpty())
    <div id="agendas">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#filtrar">
                    Filtrar agendas <i class="material-icons">arrow_drop_down</i>
                </a>
            </div>
            <div id="filtrar" class="collapse" data-parent="#agendas">
                <div class="card-body">
                    @foreach($agendas as $agenda)
                        <div class="agenda custom-control custom-checkbox">
                            <input checked type="checkbox" id="agenda{{$agenda->id}}" class="custom-control-input" value="{{$agenda->id}}" name="agenda{{$agenda->id}}">
                            <label class="custom-control-label" for="agenda{{$agenda->id}}">{{$agenda->titulo}}</label>
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
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
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
            width: 150px;
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
            margin-right: 15px;
        }

        .agenda label {
            margin: 0;
        }

        .card-link{
            display: inline-flex;
            vertical-align: middle;
        }
    </style>
@endsection

@section('js')
    @parent

    <script type="text/javascript" src="{{Module::asset(config('calendario.id').':bootbox.all.min.js')}}"></script>
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

    <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

    <script type="text/javascript">
        //TODO resolver erro de stackoverflow quando a página é exibida pelo back do navegador
        $(function () {
            var agendas = {!! $agendas !!};

            $('#icone-notificacao').on('click', function (e) {
                $('#eventoNotificacao :input').prop('disabled', function (i, v) {
                    return !v;
                });
                $(this).text(function (i, v) {
                    return v === 'notifications_on' ? 'notifications_off' : 'notifications_on';
                });
                e.preventDefault();
            });

            $('#eventoDataInicio, #eventoDataFim').datetimepicker({
                locale: 'pt-br'
            });

            $("#eventoDataInicio").on("change.datetimepicker", function (e) {
                $('#eventoDataFim').datetimepicker('minDate', e.date);
                $('#eventoDataFim').datetimepicker('date', e.date);
            });

            $('#eventoDiaTodo').change(function () {
                if (this.checked) {
                    $('#eventoDataInicio').datetimepicker('format', 'L');
                    $('#eventoDataFim').datetimepicker('format', 'L');
                } else {
                    $('#eventoDataInicio').datetimepicker('format', false);
                    $('#eventoDataFim').datetimepicker('format', false);
                }
            });

            var calendarEl = document.getElementById('calendario');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',
                height: 'parent',
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'bootstrap'],
                themeSystem: 'bootstrap',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                events: '{{route('eventos.index')}}',
                dateClick: function (info) {
                    if (agendas.length <= 0) {
                        bootbox.confirm({
                            title: "Nenhuma agenda cadastrada",
                            message: "Para criar eventos você deve possui ao menos uma agenda para vínculá-los. Deseja criar uma agenda agora?",
                            locale: 'br',
                            callback: function (result) {
                                if (result == true) {
                                    window.location.href = '{{route('agendas.criar')}}'
                                }
                            }
                        });
                    } else {
                        $('#eventoDataInicio').datetimepicker('date', info.date);
                        $('#eventoModal').modal('show');
                    }
                },
                eventClick: function (info) {
                    alert('Event: ' + info.event.id);
                }
            });

            calendar.render();
        });
    </script>
@endsection
