@extends('calendario::template')

@section('title', 'Calendário')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="eventoModal" tabindex="-1" role="dialog" aria-labelledby="eventoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventoModalLabel">Novo evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('eventos.criar')}}" id="eventoForm" method="post">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-11">
                                    <input type="text" class="form-control" id="eventoTitulo" placeholder="Título">
                                </div>
                                <div class="col-1">
                                    <select id="eventoCor">
                                        <option value="A0522D" data-color="#A0522D">sienna</option>
                                        <option value="CD5C5C" data-color="#CD5C5C">indianred</option>
                                        <option value="FF4500" data-color="#FF4500">orangered</option>
                                        <option value="DC143C" data-color="#DC143C">crimson</option>
                                        <option value="FF8C00" data-color="#FF8C00">darkorange</option>
                                        <option value="C71585" data-color="#C71585">mediumvioletred</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-6">
                                    <input type="date" class="form-control" id="eventoDataInicio" placeholder="Início">
                                </div>
                                <div class="col-5">
                                    <input type="date" class="form-control" id="eventoDataInicio" placeholder="Início">
                                </div>
                                <div class="col-1">
                                    <i class="material-icons">alarm</i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <input type="time" class="form-control" id="eventoHoraInicio">
                                </div>
                                <div class="col">
                                    <input type="time" class="form-control" id="eventoHoraFim">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <select id="eventoAgenda" class="form-control">
                                <option value="Pessoal">Pessoal</option>
                                <option value="Pessoal">Pessoal</option>
                                <option value="Pessoal">Pessoal</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="eventoForm" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="calendario"></div>
@stop

@section('css')
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
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/css/bootstrap-colorselector.css')}}">
    @parent
@endsection

@section('js')
    <script src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/main.min.js')}}"></script>
    <script src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/daygrid/main.min.js')}}"></script>
    <script src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/interaction/main.min.js')}}"></script>
    <script src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/timegrid/main.min.js')}}"></script>
    <script src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/list/main.min.js')}}"></script>
    <script src="{{Module::asset(config('calendario.id').':fullcalendar-4.2.0/packages/core/locales/pt-br.js')}}"></script>
    <script src="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/js/bootstrap-colorselector.js')}}"></script>
    <script>
        $('#eventoCor').colorselector({
            callback: function (value, color, title) {

            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendario');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'pt-br',
                height: 'parent',
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                events: '{{route('eventos')}}',
                dateClick: function (info) {
                    //console.log(info);
                    $('#eventoModal').modal('show');
                },
                eventClick: function (info) {
                    alert('Event: ' + info.event.id);
                }
            });

            calendar.render();
        });
    </script>
    @parent
@endsection