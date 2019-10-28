{{Form::label('Problema')}}

<div class="form-row">

    <div class="col-md-4 mb-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">list_alt</i>
                </span>
            </div>
            {{Form::text("problema[titulo]", $value=null,array('id'=>'problema','class' => 'form-control','placeholder'=>'Titulo','id'=> 'titulo-problema','list' => 'titulos'))}}
            <datalist id="titulos">
            </datalist>
        </div>
    </div>
    {{Form::textarea("descricao",null,array('id'=>'descricao','class' => 'form-control','placeholder'=>'Descrição Problema'))}}
</div>
<br>