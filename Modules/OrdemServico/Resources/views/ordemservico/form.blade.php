@extends('ordemservico::layouts.informacoes')
@section('content')


<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">{{$data['title']}}</div>
    <div class="card-body">

        {{ Form::open(array('url' => $data['url'] , 'method'=>'post')) }}
        {{Form::token()}}
        @if($data['model'])
        @method('PUT')
        @else

        <div class="form-group">
            <div class="form-row">
                <div class="col-sm-8">
                    {{Form::label('solicitante_id','Solicitante ')}}
                </div>

                <div class="col-sm-8  col-md-6 mb-6">
                    {{Form::text("solicitante[solicitante_id]",'',array('class' => 'form-control','placeholder'=>'Identificação de solicitante'))}}
                </div>

                <a href="{{ url('ordemservico/solicitante/create') }}" class="btn btn-success">+</a>

            </div>
        </div>
        <hr>
        @endif

        {{Form::label('Aparelho')}}
        <div class="form-row">
            <div class="col-md-4 mb-3">
                {{Form::text("aparelho[id]", $data['model'] ? $data['model']->aparelho_id : old('aparelho_id'),array('id' => 'aparelho_id','class' => 'form-control','placeholder'=>'Identificação'))}}
            </div>

            <div class="col-md-4 mb-3">
                {{Form::text("aparelho[tipo_aparelho]", $data['model'] ? $data['model']->aparelho->tipo_aparelho : old('tipo_aparelho'),array('class' => 'form-control','id' =>'tipo_aparelho','placeholder'=>'Tipo de Aparelho','disabled'))}}
            </div>

            <div class="col-md-4 mb-3">
                {{Form::text("aparelho[marca]", $data['model'] ? $data['model']->aparelho->marca : old('marca'),array('class' => 'form-control','id'=>'marca','placeholder'=>'Marca','disabled'))}}
            </div>
        </div>
        <hr>

        {{Form::label('Problema')}}

        <div class="form-row">

            <div class="col-md-4 mb-3">
                {{Form::text("problema[titulo]", $data['model'] ? $data['model']->problema->titulo : old('titulo'),array('class' => 'form-control','placeholder'=>'Titulo'))}}
            </div>
            {{Form::textarea("ordem_servico[descricao]", $data['model'] ? $data['model']->descricao : old('descricao'),array('class' => 'form-control','placeholder'=>'Descrição Problema'))}}
        </div>
        <br>

        <div class="form-group">
            {{Form::submit( $data['button'],array('class'=>"btn btn-success") )}}
            <a href="{{ url('ordemservico/os') }}" class="btn btn-primary">Voltar</a>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        //Busca Aparelho , se existir preenche atributos do aparelho automaticamente
        $('#aparelho_id').keyup(function() {
            $.getJSON("/ordemservico/aparelho/showAjax", {
                id: $('#aparelho_id').val()
            }, function() {
                console.log("success");
            }).done(function(data) {
                $('#tipo_aparelho').val(data.tipo_aparelho).prop('disabled', true);
                $('#marca').val(data.marca).prop('disabled', true);
            }).fail(function() {
                $('#tipo_aparelho').val("").prop('disabled', false);
                $('#marca').val("").prop('disabled', false);
            })
        });
    });
</script>
@endsection