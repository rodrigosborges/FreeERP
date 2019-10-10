
<strong>
    <h6 class="mb-3">Dados Solicitante</h6>
</strong>
<hr>
<div class="row">
    <div class="col-lg-9">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                {{Form::label('solicitante[identificacao]','Identificação * ')}}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    {{Form::text("solicitante[identificacao]",$value=null,array('class' => 'form-control','placeholder'=>'CPF / CNPJ'))}}
                </div>
                <span class="errors"> {{ $errors->first('solicitante.cpf') }} </span>
            </div>
            <div class="col-md-6 mb-3">
                {{Form::label('solicitante[nome]','Nome * ')}}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    {{Form::text("solicitante[nome]",$value=null,array('class' => 'form-control','placeholder'=>'Nome Completo'))}}
                </div>
                <span class="errors"> {{ $errors->first('solicitante.nome') }} </span>
            </div>
        </div>
    </div>
</div>
