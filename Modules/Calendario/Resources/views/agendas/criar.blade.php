@extends('calendario::template/index')

@section('title', 'Calendário - Criar Agenda')

@section('content')
    <div class="container">
    <form action="#" id="agendaForm" method="POST">
        <div class="form-group">
            <label for="agendaNome">Título</label>
            <input type="text" id="agendaNome"class="form-control">
        </div>
        <div class="form-group">
            <label for="agendaDescricao">Descrição</label>
            <textarea id="agendaDescricao" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="agendaCor">Cor</label>
            <select id="agendaCor">
                <option value="106" data-color="#A0522D">sienna</option>
                <option value="47" data-color="#CD5C5C" selected="selected">indianred</option>
                <option value="87" data-color="#FF4500">orangered</option>
                ...
                <option value="15" data-color="#DC143C">crimson</option>
                <option value="24" data-color="#FF8C00">darkorange</option>
                <option value="78" data-color="#C71585">mediumvioletred</option>
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
        $('#agendaCor').colorselector();
    </script>
@endsection