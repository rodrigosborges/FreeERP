@extends('calendario::template/index')

@section('title', 'Calendário - Criar Agenda')

@section('content')
    <div class="container">
    <form action="{{route('agendas.salvar')}}" id="agendaForm" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="agendaNome">Título</label>
            <input type="text" name="agendaNome" id="agendaNome"class="form-control">
        </div>
        <div class="form-group">
            <label for="agendaDescricao">Descrição</label>
            <textarea name="agendaDescricao" id="agendaDescricao" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="agendaCor">Cor</label>
            <select id="agendaCor" name="agendaCor">
                <option value="A0522D" data-color="#A0522D">sienna</option>
                <option value="CD5C5C" data-color="#CD5C5C" selected="selected">indianred</option>
                <option value="FF4500" data-color="#FF4500">orangered</option>
                <option value="DC143C" data-color="#DC143C">crimson</option>
                <option value="FF8C00" data-color="#FF8C00">darkorange</option>
                <option value="C71585" data-color="#C71585">mediumvioletred</option>
            </select>
        </div>
        <button type="submit" form="agendaForm" class="btn btn-primary">Salvar</button>
    </form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/css/bootstrap-colorselector.css')}}">
    <style type="text/css">
        .btn-colorselector{
            width: 100px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/js/bootstrap-colorselector.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#agendaCor').colorselector();
        });
    </script>
@endsection