@extends('calendario::template/index')

@section('title', 'Calendário - Agenda')

@section('content')
    @parent
    <div class="container">
        <h2>
        @if(isset($agenda))
            {{$agenda->titulo}} > Editar
        @else
            Nova Agenda
        @endif
        </h2>
        <form action="{{isset($agenda) ? route('agendas.atualizar', $agenda) : route('agendas.salvar')}}"
              id="agendaForm" method="post">
            @csrf
            {{isset($agenda) ? method_field('PUT') : ''}}
            <div class="form-group">
                <label for="agendaNome" class="font-weight-bold">Título</label>
                <input type="text" name="agendaNome" id="agendaNome" class="form-control" maxlength="100"
                       value="{{isset($agenda) ? $agenda->titulo : old('agendaNome')}}" required autofocus>
            </div>
            <div class="form-group">
                <label for="agendaDescricao">Descrição</label>
                <textarea name="agendaDescricao" id="agendaDescricao" class="form-control" rows="4"
                          maxlength="500">{{isset($agenda) ? $agenda->descricao : old('agendaDescricao')}}</textarea>
            </div>
            <div class="form-group">
                <label for="agendaCor" class="font-weight-bold">Cor</label>
                <select id="agendaCor" name="agendaCor" required>
                    @foreach($cores as $cor)
                        <option value="{{$cor->id}}" data-color="#{{$cor->codigo}}"
                                @if(isset($agenda->cor) && $agenda->cor->id == $cor->id) selected @endif>{{$cor->nome}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="agendaCompartilhamento">Compartilhamento</label>
                <select id="agendaCompartilhamento" name="agendaCompartilhamento[]" class="form-control" multiple>
                    @foreach($setores as $setor)
                        @php($selected = '')
                        @if(isset($agenda))
                            @foreach($agenda->compartilhamentos as $compartilhamento)
                                @if($compartilhamento->setor_id == $setor->id)
                                    @php($selected = 'selected')
                                @endif
                            @endforeach
                        @endif
                        <option value="{{$setor->id}}" {{$selected}}>{{$setor->nome}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
@endsection

@section('css')
    @parent
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/css/bootstrap-colorselector.css')}}">
    <link rel="stylesheet" type="text/css" href="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen-bootstrap.css')}}">
    @include('calendario::agendas.css')
@endsection

@section('js')
    @parent
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':bootstrap-colorselector-0.2.0/js/bootstrap-colorselector.js')}}"></script>
    <script type="text/javascript"
            src="{{Module::asset(config('calendario.id').':chosen-1.8.7/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#agendaCor').colorselector();
            $('#agendaCompartilhamento').chosen({
                placeholder_text_multiple: 'Setores'
            });
        });
    </script>
@endsection
