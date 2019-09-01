<div class="form-group row">
    <div class="input-group col">

        <!--<input class="form-control" name="selecionarTecnico" type="text" placeholder="Tecnico responsavel"> -->
        <select style="width:100%;" name="selecionarTecnico" id="selecionarTecnico" class="form-control multi-select">
            <option value="" disabled selected>Selecionar tecnico</option>
            @foreach($tecnicos as $tecnico)
            <option value="{{ $tecnico->id }}" data-puxar="{{ $tecnico->nome }}|{{ $tecnico->cpf }}">
                {{ $tecnico->nome }}|{{ $tecnico->cpf }}</option>
            @endforeach
        </select>
        <div class="col-12">
            <span class="errors"> {{ $errors->first('idTecnico') }} </span>
        </div>
    </div>
</div>

<div class="form-group row">

    <input type="hidden" name="idTecnico"
        value="{{isset($conserto->idTecnico) ? $conserto->idTecnico : old('idTecnico', '')}}">
    <div class="input-group col">
        <div class="input-group-prepend">
            <span class="input-group-text" id="nome"><i class="material-icons">person</i></span>
        </div>
        <input class="form-control" name="nome-tecnico" type="text" placeholder="Nome completo"
            value="{{ isset($conserto->tecnico->nome) ? $conserto->tecnico->nome : old('nome', '') }}" readonly="">
    </div>
    <div class="input-group col">
        <div class="input-group-prepend">
            <span class="input-group-text" id="cpf"><i class="material-icons">account_box</i></span>
        </div>
        <input type="text" class="form-control cpf-mask" name="cpf-tecnico" placeholder="000.000.000-00" readonly
            value="{{ isset($conserto->tecnico->cpf) ? $conserto->tecnico->cpf : old('cpf', '') }}">
    </div>
</div>