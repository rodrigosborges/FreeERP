<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="tecnico"><i class="material-icons">person</i></span>
        </div>
        <input class="form-control" name="nome" type="text" placeholder="Nome completo"
            value="{{ isset($tecnico->nome) ? $tecnico->nome : old('nome', '') }}">
    </div>
    <span class="errors"> {{ $errors->first('nome') }} </span>
</div>

<div class="form-group">
    <div class="form-row">
        <div class="col">
            <div class="input-group">
                <div class="input-group-preppend">
                    <span class="input-group-text" id="tecnico"><i class="material-icons">picture_in_picture</i></span>
                </div>
                <input type="text" class="form-control cpf-mask" name="cpf" placeholder="000.000.000-00 (CPF)"
                    value="{{ isset($tecnico->cpf) ? $tecnico->cpf : old('cpf', '') }}">
            </div>

            <span class="errors"> {{ $errors->first('cpf') }} </span>
        </div>


    </div>
</div>