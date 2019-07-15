@extends('calendario::template/index')

@section('title', 'Calendário - Criar Agenda')

@section('content')
    @parent
    <div class="container">
    <form action="{{route('agendas.salvar')}}" id="agendaForm" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="agendaNome">Título</label>
            <input type="text" name="agendaNome" id="agendaNome"class="form-control" maxlength="100" required>
        </div>
        <div class="form-group">
            <label for="agendaDescricao">Descrição</label>
            <textarea name="agendaDescricao" id="agendaDescricao" class="form-control" rows="4" maxlength="500"></textarea>
        </div>
        <div class="form-group">
            <label for="agendaCor">Cor</label>
            <select id="agendaCor" name="agendaCor" required>
                @foreach($cores as $cor)
                <option value="{{$cor->id}}" data-color="#{{$cor->codigo}}">{{$cor->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="agendaCompartilhar">Compartilhar</label>
            <select id="agendaCompartilhar" name="agendaCompartilhar" class="form-control" multiple data-placeholder="Selecione os setores">
                <option value="CTI">CTI</option>
                <option value="CTI">DRG</option>
                <option value="CTI">RET</option>
            </select>
        </div>
        <button type="submit" form="agendaForm" class="btn btn-primary">Salvar</button>
    </form>
    </div>
@endsection

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/css/bootstrap-colorselector.css')}}">
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen.css')}}">
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen-bootstrap.css')}}">
    <style type="text/css">
        .color-btn{
            border: 1px solid #000000;
        }
        .btn-colorselector{
            width: 100px;
            border: 1px solid #ced4da;
        }
        .dropdown-colorselector>.dropdown-menu>li>.color-btn.selected:after{
            font-family: "Material Icons";
            content: "\e5ca";
        }
    </style>
@endsection

@section('js')
    @parent
    <script type="text/javascript" src="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/js/bootstrap-colorselector.js')}}"></script>
    <script type="text/javascript" src="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#agendaCor').colorselector();
            $('#agendaCompartilhar').chosen({
            });
        });
    </script>
@endsection