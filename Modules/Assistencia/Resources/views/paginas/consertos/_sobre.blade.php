
<div class="form-group row">
	<div class="col-6">
	  <input  type="text" name="modelo_aparelho" class="form-control" placeholder="Modelo do aparelho" value="{{ isset($conserto->modelo_aparelho) ? $conserto->modelo_aparelho : old('modelo_aparelho', '') }}">
	  <div class="col-12 ">
	      <span class="errors"> {{ $errors->first('modelo_aparelho') }} </span>
	    </div>
	</div>
	
	<div class="col-6">
	  <input  type="text" name="marca_aparelho" class="form-control" placeholder="Marca do aparelho" value="{{ isset($conserto->marca_aparelho) ? $conserto->marca_aparelho : old('marca_aparelho', '') }}">
	  <div class="col-12">
	      <span class="errors"> {{ $errors->first('marca_aparelho') }} </span>
	    </div>
	</div>
	
</div>

<div class="form-group row">
	<div class="col-6">
	  <input  type="text" name="serial_aparelho" class="form-control" placeholder="Código serial" value="{{ isset($conserto->serial_aparelho) ? $conserto->serial_aparelho : old('serial_aparelho', '') }}">
	  <div class="col-12">
	      <span class="errors"> {{ $errors->first('serial_aparelho') }} </span>
	    </div>
	</div>
	
	<div class="col-6">
	  <input  type="text" name="imei_aparelho" class="form-control" placeholder="Imei do aparelho" value="{{ isset($conserto->imei_aparelho) ? $conserto->imei_aparelho : old('imei_aparelho', '') }}">
	  <div class="col-12">
	      <span class="errors"> {{ $errors->first('imei_aparelho') }} </span>
	    </div>
	</div>
	
</div>

<div class="form-group row">
	<div class="col-6">
	  <input  type="text" name="defeito" class="form-control" placeholder="Defeito/Reclamação" value="{{ isset($conserto->defeito) ? $conserto->defeito : old('defeito', '') }}">
	  <div class="col-12">
	      <span class="errors"> {{ $errors->first('defeito') }} </span>
	    </div>
	</div>
	
	<div class="col-6">
	  <input  class="form-control" type="text" name="obs" placeholder="Observações" id="" rows="3" value="{{ isset($conserto->obs) ? $conserto->obs : old('obs', '') }}"></input>
	  <div class="col-12">
	      <span class="errors"> {{ $errors->first('obs') }} </span>
	    </div>
	</div>
	
</div>


