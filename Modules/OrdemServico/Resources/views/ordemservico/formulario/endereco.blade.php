<div class="form-row">
    <div class="col-md-3 mb-1">
        {{Form::label('solicitante[endereco.rua]','Endereco * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("solicitante[endereco.rua]",$value=null,array('class' => 'form-control','placeholder'=>'Rua exemplo '))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.endereco.rua') }} </span>
    </div>
    <div class="col-md-3 mb-1">
        {{Form::label('solicitante[endereco.bairro]','Bairro * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("solicitante[endereco.bairro]",$value=null,array('class' => 'form-control','placeholder'=>'Bairro'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.bairro') }} </span>
    </div>

    <div class="col-md-2 mb-2">
        {{Form::label('solicitante[endereco.numero]','Numero * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("solicitante[endereco.numero]",$value=null,array('class' => 'form-control','placeholder'=>'Numero'))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.numero') }} </span>
    </div>

    <div class="col-md-2 mb-1">
        {{Form::label('solicitante[endereco.uf]','Estado* ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::select("solicitante[endereco.uf_id]",$data['uf'],null,array('class' => 'form-control','placeholder'=>'Estado '))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.endereco.estado') }} </span>
    </div>
    <div class="col-md-2 mb-1">
        {{Form::label('solicitante[endereco.cidade]','Cidade * ')}}
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">location_on</i>
                </span>
            </div>
            {{Form::text("solicitante[endereco.cidade]",$value=null,array('class' => 'form-control','placeholder'=>'Cidade '))}}
        </div>
        <span class="errors"> {{ $errors->first('solicitante.endereco.cidade') }} </span>
</div>
</div>
