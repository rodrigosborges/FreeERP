
<div class="form-group row">
	<div class="col">
	  <input required type="text" name="modelo_aparelho" class="form-control" placeholder="Modelo do aparelho" value="{{ isset($conserto->modelo_aparelho) ? $conserto->modelo_aparelho : old('modelo_aparelho', '') }}">
	</div>
	<div class="col">
	  <input required type="text" name="marca_aparelho" class="form-control" placeholder="Marca do aparelho" value="{{ isset($conserto->marca_aparelho) ? $conserto->marca_aparelho : old('marca_aparelho', '') }}">
	</div>
</div>
<div class="form-group row">
	<div class="col">
	  <input required type="text" name="serial_aparelho" class="form-control" placeholder="Código serial" value="{{ isset($conserto->serial_aparelho) ? $conserto->serial_aparelho : old('serial_aparelho', '') }}">
	</div>
	<div class="col">
	  <input required type="text" name="imei_aparelho" class="form-control" placeholder="Imei do aparelho" value="{{ isset($conserto->imei_aparelho) ? $conserto->imei_aparelho : old('imei_aparelho', '') }}">
	</div>
</div>
<div class="form-group row">
	<div class="col">
	  <input required type="text" name="defeito" class="form-control" placeholder="Defeito/Reclamação" value="{{ isset($conserto->defeito) ? $conserto->defeito : old('defeito', '') }}">
	</div>
	<div class="col">
	  <input required class="form-control" type="text" name="obs" placeholder="Observações" id="" rows="3" value="{{ isset($conserto->obs) ? $conserto->obs : old('obs', '') }}"></input>
	</div>
</div>




Valor total
