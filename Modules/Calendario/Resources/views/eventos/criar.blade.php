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
                <form action="{{route('eventos.salvar')}}" id="eventoForm" method="post">
                @csrf

                <!-- Titulo -->
                    <div class="form-group">
                        <label for="eventoTitulo">Título</label>
                        <input type="text" class="form-control" id="eventoTitulo" name="eventoTitulo" required>
                    </div>

                    <!-- Data -->
                    <div class="form-group">
                        <label for="eventoDataInicio">Período</label>
                        <div class="input-group">
                            <input type="text" class="form-control datetimepicker-input" name="eventoDataInicio"
                                   id="eventoDataInicio" data-toggle="datetimepicker" data-target="#eventoDataInicio"
                                   required>
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text">
                                    <i class="material-icons">date_range</i>
                                </span>
                            </div>
                            <input type="text" class="form-control datetimepicker-input" name="eventoDataFim"
                                   id="eventoDataFim" data-toggle="datetimepicker" data-target="#eventoDataFim"
                                   required>
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
                                       value="10">
                            </div>
                            <div class="col-3">
                                <select name="eventoNotificacaoPeriodo" class="form-control">
                                    <option value="60">minutos</option>
                                    <option value="3600">horas</option>
                                    <option value="86400">dias</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <a href="#">
                                    <i class="material-icons" id="icone-notificacao">notifications_on</i></a>
                            </div>
                        </div>
                        <div class="small custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="eventoNotificacaoEmail">
                            <label class="custom-control-label" for="eventoNotificacaoEmail">Também notificar via
                                e-mail</label>
                        </div>
                    </div>

                    <!-- Agenda -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="eventoAgenda">Agenda</label>
                            <select id="eventoAgenda" class="form-control" name="eventoAgenda" required>
                                @foreach($agendas as $agenda)
                                    <option value="{{$agenda->id}}">{{$agenda->titulo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Nota -->
                    <div class="form-group">
                        <label for="eventoNota">Descrição</label>
                        <textarea class="form-control" name="eventoNota" id="eventoNota" rows="3"></textarea>
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
