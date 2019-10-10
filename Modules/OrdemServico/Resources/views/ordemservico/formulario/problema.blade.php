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