<div class="row form-group">
  <div class="col-12 ">
  <label for="">Selecione as peças</label>
    <select style="width:100%;" name="pecas[]" id="valor_peca" class="form-control multi-select"  multiple="true">
      @foreach($pecas as $peca) <!-- aqui o retorno é o id da peça -->
            <option data-valor="{{$peca->valor_venda}}" value="{{ $peca->id }}">{{ $peca->nome }} |  {{ $peca->valor_venda }}</option>
      @endforeach 
    </select>
  </div>
</div>
    
