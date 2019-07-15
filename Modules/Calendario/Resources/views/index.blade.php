@extends('calendario::template/index')

@section('title', 'Calendário')

@section('content')
    @parent
    @include('calendario::eventos/criar')
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
        .fc-body{
            cursor: cell;
        }
        .fc-event-container{
            cursor: pointer;
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
        $(function() {
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
                dateClick: function (info){
                    if(agendas.length <= 0){
                        bootbox.confirm({
                            title: "Ooops...",
                            message: "Para criar um evento você deve possui ao menos uma agenda. Deseja criar uma agenda agora?",
                            locale: 'br',
                            callback: function (result) {
                                if(result == true){
                                    window.location.href = '{{route('agendas.criar')}}'
                                }
                            }
                        });
                    }
                    else{
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