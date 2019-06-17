@extends('calendario::template')

@section('title', 'Calendário')

@section('content')
    <div class="d-flex flex-row">
        <div class="mr-3" id="agendas">
            <span class="font-weight-bold">Minhas Agendas</span>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Minha agenda 1
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                    Minha agenda 2
                </label>
            </div>
            <span class="font-weight-bold">Outras Agendas</span>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck12">
                <label class="form-check-label" for="defaultCheck12">
                    Checkbox padrão
                </label>
            </div>

        </div>
        <div class="flex-fill" id="calendario">
            Calendário
        </div>
    </div>
@stop

