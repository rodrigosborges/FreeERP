<div class="form-row">
<div class="col-md-3 mb-1">
        {{Form::label('endereco[cep]','CEP (opcional) ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("endereco[cep]",$value=null,array('class' => 'form-control','placeholder'=>'CEP','id'=>'cep'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.endereco.rua') }} </span>
</div>
    <div class="col-md-5 mb-1">
        {{Form::label('endereco[rua]','Rua * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("endereco[rua]",$value=null,array('class' => 'form-control','placeholder'=>'Rua exemplo ','id'=>'logradouro'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.endereco.rua') }} </span>
    </div>
    <div class="col-md-4 mb-1">
        {{Form::label('endereco[bairro]','Bairro * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("endereco[bairro]",$value=null,array('id'=> 'bairro' , 'class' => 'form-control','placeholder'=>'Bairro'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.bairro') }} </span>
    </div>
    <div class="col-md-3 mb-1">
        {{Form::label('endereco[estado_id]','Estado* ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::select("endereco[estado_id]",$data['estado'],null,array('class' => 'form-control','id'=>'uf'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.endereco.estado') }} </span>
    </div>
    <div class="col-md-3 mb-1">
        {{Form::label('endereco[cidade_id]','Cidade * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::select("endereco[cidade_id]",$data['cidade'],null,array('class' => 'form-control','id'=>'localidade'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.endereco.cidade') }} </span>
</div>
<div class="col-md-2 mb-2">
        {{Form::label('endereco[numero]','Numero * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("endereco[numero]",$value=null,array('class' => 'form-control','placeholder'=>'Numero'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.numero') }} </span>
    </div>

    <div class="col-md-4 mb-2">
        {{Form::label('endereco[complemento]','Complemento (opcional)')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("endereco[complemento]",$value=null,array('class' => 'form-control','placeholder'=>'Complemento','id'=>'complemento'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.complemento') }} </span>
    </div>
</div>
