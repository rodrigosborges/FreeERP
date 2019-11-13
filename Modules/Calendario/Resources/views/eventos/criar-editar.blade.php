@extends('calendario::template/index')

@section('title', 'Calendário - Evento')

@section('content')
    @parent
    <div class="container">
        <h2>
            @if(isset($evento))
                <a href="{{route('agendas.eventos.index', $evento->agenda->id)}}">{{$evento->agenda->titulo}}</a> > {{$evento->titulo}}
                @if($rota == 'eventos.duplicar')
                    > Duplicar
                @else
                    > Editar
                @endif
            @else
                Novo Evento
            @endif
        </h2>
        <form action="{{isset($evento) && $rota != 'eventos.duplicar' ? route('eventos.editar', $evento->id) : route('eventos.salvar')}}" id="eventoForm"
              method="post" autocomplete="off">
        @csrf
        {{isset($evento) && $rota != 'eventos.duplicar' ? method_field('PUT') : ''}}

        <!-- Titulo -->
            <div class="form-group">
                <label for="eventoTitulo">Título</label>
                <input type="text" class="form-control" id="eventoTitulo" name="eventoTitulo" value="{{isset($evento) ? $evento->titulo : old('eventoTitulo')}}"
                       required autofocus maxlength="100">
            </div>

            <!-- Data -->
            <div class="form-group">
                <label for="eventoDataInicio">Período</label>
                <div class="input-group">
                    <input type="text" class="form-control datetimepicker-input" name="eventoDataInicio"
                           id="eventoDataInicio" data-toggle="datetimepicker" data-target="#eventoDataInicio" required>
                    <div class="input-group-prepend input-group-append">
                                <span class="input-group-text">
                                    <i class="material-icons">date_range</i>
                                </span>
                    </div>
                    <input type="text" class="form-control datetimepicker-input" name="eventoDataFim"
                           id="eventoDataFim" data-toggle="datetimepicker" data-target="#eventoDataFim" required>
                </div>
                <div class="small custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="eventoDiaTodo" name="eventoDiaTodo"
                           value="1">
                    <label class="custom-control-label" for="eventoDiaTodo">Dia todo</label>
                </div>
            </div>

            <!-- Notificacao -->
            <div class="form-group" id="eventoNotificacao">
                <label>Notificação</label>
                <div class="form-row">
                    <div class="col-2">
                        <input type="number" min="1" max="999" class="form-control text-center" name="eventoNotificacaoTempo"
                            {{isset($evento->notificacao) ? 'value=' . $evento->notificacao->tempo : 'value=10 disabled'}}>
                    </div>
                    <div class="col-3">
                        <select name="eventoNotificacaoPeriodo" class="form-control" {{isset($evento->notificacao) ? '' : 'disabled'}}>
                            <option value="60" @if(isset($evento->notificacao) && $evento->notificacao->periodo == '60') selected @endif>minutos</option>
                            <option value="3600" @if(isset($evento->notificacao) && $evento->notificacao->periodo == '3600') selected @endif>horas</option>
                            <option value="86400" @if(isset($evento->notificacao) && $evento->notificacao->periodo == '86400') selected @endif>dias</option>
                        </select>
                    </div>
                    <div class="form-inline">
                        <a href="#">
                            <i class="material-icons" id="icone-notificacao">{{isset($evento->notificacao) ? 'notifications_on' : 'notifications_off'}}</i></a>
                    </div>
                </div>
                <div class="small custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="eventoNotificacaoEmail" id="eventoNotificacaoEmail" value="1"
                           @if(isset($evento->notificacao)) @if(isset($evento->notificacao->email)) checked @else @endif @else disabled @endif>
                    <label class="custom-control-label" for="eventoNotificacaoEmail">Também notificar via
                        e-mail</label>
                </div>
            </div>

            <!-- Nota -->
            <div class="form-group">
                <label for="eventoNota">Descrição</label>
                <textarea class="form-control" maxlength="500" name="eventoNota" id="eventoNota"
                          rows="3">{{isset($evento) ? $evento->nota : old('eventoNota')}}</textarea>
            </div>

            <!-- Convites -->
            <div class="form-group">
                <label for="eventoConvite">Convite</label>
                <select id="eventoConvite" name="eventoConvite[]" class="form-control" multiple>
                    @foreach($funcionarios as $funcionario)
                        @php($selected = '')
                        @php($status = '')
                        @if(isset($evento))
                            @foreach($evento->convites as $convite)
                                @if($convite->funcionario_id == $funcionario->id)
                                    @php($selected = 'selected')
                                    @if($convite->status == true)
                                        @php($status = true)
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        @if($funcionario->id != auth()->id())
                            <option value="{{$funcionario->id}}" {{$selected}}>{{$funcionario->nome}} @if($status) &#10004; @endif</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Agenda -->
            <div class="form-row">
                <div class="form-group">
                    <label for="eventoAgenda">Agenda</label>
                    <select id="eventoAgenda" class="form-control" name="eventoAgenda" required
                            @if(isset($evento) && $rota != 'eventos.duplicar') disabled @endif>
                        @foreach($agendas as $agenda)
                            <option value="{{$agenda->id}}" @if($evento) @if($agenda->id == $evento->agenda->id) selected
                                    @endif @elseif($agenda_selecionada == $agenda->id) selected @endif>{{$agenda->titulo}}
                            </option>
                        @endforeach
                    </select>
                    @if(isset($evento) && $rota != 'eventos.duplicar')
                        <input type="hidden" name="eventoAgenda" value="{{$agenda->id}}">
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            @if(isset($evento) && $rota != 'eventos.duplicar')
                <a href="{{route('eventos.deletar', $evento->id)}}" class="btn btn-secondary text-white deletar-evento">
                    Deletar
                </a>
            @endif
        </form>
    </div>
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen-bootstrap.css')}}">
@endsection

@section('js')
    @parent
    @if($evento)
        @include('calendario::eventos.js')
    @endif
    <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
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
                locale: 'pt-br',
                useCurrent: false,
                date: localStorage.getItem('cal-data')
            }, localStorage.setItem('cal-data', moment().format('MM/DD/YYYY')));

            $("#eventoDataInicio").on("change.datetimepicker", function (e) {
                $('#eventoDataFim').datetimepicker('date', e.date);
                $('#eventoDataFim').datetimepicker('minDate', e.date);
            });

            $('#eventoDiaTodo')
                .on('change', function () {
                    if (this.checked) {
                        $('#eventoDataInicio').datetimepicker('format', 'L');
                        $('#eventoDataFim').datetimepicker('format', 'L');
                    } else {
                        $('#eventoDataInicio').datetimepicker('format', false);
                        $('#eventoDataFim').datetimepicker('format', false);
                    }
                });

            var evento = JSON.parse('{!! $evento !!}' || '[]');
            var formato_input, formato_data;

            if (Object.keys(evento).length > 2) {
                if (evento.dia_todo) {
                    formato_data = 'DD/MM/YYYY';
                    formato_input = 'L';
                    $('#eventoDiaTodo').prop('checked', true)
                } else {
                    formato_data = 'DD/MM/YYYY HH:mm';
                    formato_input = false;
                }

                $('#eventoDataInicio').datetimepicker('format', formato_input);
                $('#eventoDataInicio').datetimepicker('date', moment(evento.data_inicio).format(formato_data));
                $('#eventoDataFim').datetimepicker('format', formato_input);
                $('#eventoDataFim').datetimepicker('date', moment(evento.data_fim).format(formato_data));
            }

            $('#eventoConvite').chosen({
                placeholder_text_multiple: 'Funcionários'
            });
        });
    </script>
@endsection
