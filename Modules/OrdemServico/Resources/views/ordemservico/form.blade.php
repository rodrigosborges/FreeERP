@extends('ordemservico::layouts.form')
@section('formulario')

@if(isset($data['model']))
{{ Form::model($data['model'], array('route' => array('modulo.os.update', $data['model']->id), 'method' => 'put')) }}
@endif

@if(!isset($data['model']))
<div class="form-group">
    <div class="form-row">
        <div class="col-sm-8">
            {{Form::label('solicitante_id','Solicitante ')}}
        </div>

        <div class="col-sm-8  col-md-6 mb-6">
            {{Form::text("solicitante[solicitante_id]",$value=null,array('class' => 'form-control','placeholder'=>'Identificação de solicitante'))}}
        </div>

        <a href="{{route('modulo.solicitante.create')}}" class="text-white btn btn-success">+</a>

    </div>
</div>
<hr>
@endif

{{Form::label('Aparelho')}}
<div class="form-row">
    <div class="col-md-4 mb-3">
        {{Form::text("aparelho[id]", $value=null,array('id' => 'aparelho_id','class' => 'form-control','placeholder'=>'Identificação'))}}
    </div>

    <div class="col-md-4 mb-3">
        {{Form::text("aparelho[tipo_aparelho]", $value=null ,array('class' => 'form-control','id' =>'tipo_aparelho','placeholder'=>'Tipo de Aparelho','disabled'))}}
    </div>

    <div class="col-md-4 mb-3">
        {{Form::text("aparelho[marca]", $value=null ,array('class' => 'form-control','id' =>'marca','placeholder'=>'Marca','disabled'))}}
    </div>

</div>
<hr>

{{Form::label('Problema')}}

<div class="form-row">

    <div class="col-md-4 mb-3">
        {{Form::text("problema[titulo]", $value=null,array('class' => 'form-control','placeholder'=>'Titulo','id'=> 'titulo-problema','list' => 'titulos'))}}
        <datalist id="titulos">
        </datalist>
    </div>
    {{Form::textarea("descricao",null,array('class' => 'form-control','placeholder'=>'Descrição Problema'))}}
</div>
<br>
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

        //Gerando opção do datalist de titulos
        function gerarOpcao(itens) {
            itens.forEach(item => {
                $('#titulos').append('<option value=' + item.titulo + ">");
            });
        }

        //Buscando Titulo de problema 
        $.getJSON("/ordemservico/problema/showAjax", {}, function() {
            console.log("success");
        }).done(function(data) {
            gerarOpcao(data);

        }).fail(function() {
            console.log("error");
        })
    });
</script>
@endsection