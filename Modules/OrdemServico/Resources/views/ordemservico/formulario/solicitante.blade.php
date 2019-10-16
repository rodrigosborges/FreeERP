<strong>
    <h6 class="mb-3">Dados Solicitante</h6>
</strong>
<hr>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                {{Form::label('solicitante[identificacao]','Identificação * ')}}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">person</i>
                        </span>
                    </div>
                    {{Form::text("solicitante[id]",$value=null,array('class' => 'form-control','placeholder'=>'CPF / CNPJ'))}}
                </div>
                <span class="errors"> {{ $errors->first('solicitante.id') }} </span>
            </div>
            <div class="col-md-5 mb-3">
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
    
        <div class="col-md-4 mb-3">
            {{Form::label('solicitante[email]','Email * ')}}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">person</i>
                    </span>
                </div>
                {{Form::text("solicitante[email]",$value=null,array('class' => 'form-control','placeholder'=>'Email'))}}
            </div>
            <span class="errors"> {{ $errors->first('solicitante.email') }} </span>
        </div>
    </div>
  
