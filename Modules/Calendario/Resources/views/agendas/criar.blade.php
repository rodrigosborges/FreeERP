@extends('calendario::template/index')

@section('title', 'Calendário - Criar Agenda')

@section('content')
    <div class="container">
    <form action="{{route('agendas.salvar')}}" id="agendaForm" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="agendaNome">Título</label>
            <input type="text" name="agendaNome" id="agendaNome"class="form-control" required>
        </div>
        <div class="form-group">
            <label for="agendaDescricao">Descrição</label>
            <textarea name="agendaDescricao" id="agendaDescricao" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="agendaCor">Cor</label>
            <select id="agendaCor" name="agendaCor">
                <option value="C0C0C0" data-color="#C0C0C0">Prata</option>
                <option value="808080" data-color="#808080">Cinza</option>
                <option value="000000" data-color="#000000">Preto</option>
                <option value="FF0000" data-color="#FF0000">Vermelho</option>
                <option value="800000" data-color="#800000">Marrom</option>
                <option value="FFFF00" data-color="#FFFF00">Amarelo</option>
                <option value="808000" data-color="#808000" selected="selected">Oliva</option>
                <option value="00FF00" data-color="#00FF00">Lima</option>
                <option value="008000" data-color="#008000">Verde</option>
                <option value="00FFFF" data-color="#00FFFF">Água</option>
                <option value="008080" data-color="#008080">Verde-azulado</option>
                <option value="0000FF" data-color="#0000FF">Azul</option>
                <option value="000080" data-color="#000080">Azul-marinho</option>
                <option value="FF00FF" data-color="#FF00FF">Magenta</option>
                <option value="800080" data-color="#800080">Roxo</option>
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
        .btn-colorselector{
            width: 100px;
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