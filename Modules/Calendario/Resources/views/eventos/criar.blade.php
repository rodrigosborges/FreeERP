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
                        <label>Data</label>
                        <div class="form-row">
                            <div class="col-4">
                                <div class="input-group date" id="eventoDataInicio" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                           data-target="#eventoDataInicio" name="eventoDataInicio" required/>
                                    <div class="input-group-append" data-target="#eventoDataInicio"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <span>até</span>
                            </div>
                            <div class="col-4">
                                <div class="input-group date" id="eventoDataFim" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                           data-target="#eventoDataFim" name="eventoDataFim"/>
                                    <div class="input-group-append" data-target="#eventoDataFim"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <a href="#"><i class="material-icons" id="icone-relogio">access_time</i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Hora -->
                    <div class="form-group" id="eventoHora">
                        <div class="form-row">
                            <div class="col-4">
                                <div class="input-group date" id="eventoHoraInicio" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input text-center"
                                           data-target="#eventoHoraInicio" name="eventoHoraInicio"/>
                                    <div class="input-group-append" data-target="#eventoHoraInicio"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-inline">
                                <span>até</span>
                            </div>
                            <div class="col-4">
                                <div class="input-group date" id="eventoHoraFim" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input text-center"
                                           data-target="#eventoHoraFim" name="eventoHoraFim"/>
                                    <div class="input-group-append" data-target="#eventoHoraFim"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notificacao -->
                    <div class="form-group" id="eventoNotificacao">
                        <label>Notificação</label>
                        <div class="form-row">
                            <div class="col-2">
                                <input type="text" class="form-control text-center" name="eventoNotificacaoTempo"
                                       value="10">
                            </div>
                            <div class="col-3">
                                <select name="eventoNotificacaoPeriodo" class="form-control">
                                    <option>minutos</option>
                                    <option>horas</option>
                                    <option>dias</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <a href="#"><i class="material-icons"
                                               id="icone-notificacao">notifications_on</i></a>
                            </div>
                        </div>
                        <small class="text-muted">
                            <input type="checkbox" name="eventoNotificacaoEmail">
                            <label for="eventoNotificacaoEmail">Também notificar via e-mail</label>
                        </small>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="eventoAgenda">Agenda</label>
                            <select id="eventoAgenda" class="form-control" name="eventoAgenda" required>
                                <option value="1">Pessoal</option>
                            </select>
                        </div>
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