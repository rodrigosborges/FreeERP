<div class="row form-group">
  <div class="col-12 ">
  <label for="">Selecione as peças</label>
    <select style="width:100%;" name="pecas[]" id="valor_peca" class="form-control multi-select"  multiple="true">

      	@foreach($pecas as $peca) 
          <option data-valor="{{$peca->peca->valor_venda}}" value="{{ $peca->id }}">{{ $peca->peca->nome }} |  {{ $peca->peca->valor_venda }}</option>
   		  @endforeach

    </select>

  </div>
</div>

