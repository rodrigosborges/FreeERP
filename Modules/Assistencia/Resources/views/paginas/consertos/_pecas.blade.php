<div class="row form-group">
  <div class="col-12 ">
  <label for="">Selecione as peças</label>
    <select style="width:100%;" name="pecas[]" id="valor_peca" class="form-control multi-select"  multiple="true">

      	@foreach($pecas as $item) 
          <option data-valor="{{$item->peca->valor_venda}}" value="{{ $item->id }}">{{ $item->peca->nome }} |  {{ $item->peca->valor_venda }}</option>
        @endforeach

    </select>

  </div>
</div>

