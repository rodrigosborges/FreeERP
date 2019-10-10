{{Form::label('Aparelho')}}
<div class="form-row">

    <div class="col-md-4 mb-3">
        {{Form::text("aparelho[id]", $value=null,array('id' => 'aparelho_id','class' => 'form-control','placeholder'=>'Numero Série'))}}
    </div>

    <div class="col-md-4 mb-3">
        {{Form::text("aparelho[tipo_aparelho]", $value=null ,array('class' => 'form-control','id' =>'tipo_aparelho','placeholder'=>'Tipo de Aparelho','disabled'))}}
    </div>

    <div class="col-md-4 mb-3">
        {{Form::text("aparelho[modelo]", $value=null ,array('class' => 'form-control','id' =>'modelo','placeholder'=>'Modelo','disabled'))}}
    </div>

    <div class="col-md-4 mb-3">
        {{Form::text("aparelho[marca]", $value=null ,array('class' => 'form-control','id' =>'marca','placeholder'=>'Marca','disabled'))}}
    </div>

    <div class="col-md-6 mb-3 form-control acessorios">
        {{Form::text("aparelho[acessorios]", $value=null ,array('style' => 'border:none','id' =>'acessorios','placeholder'=>'Acessórios'))}}
    </div>
    

</div>