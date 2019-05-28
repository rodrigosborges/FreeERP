<div class="row form-group">
  <div class="col-12 ">
    <select style="width:100%;" name="pecas[]" class="form-control multi-select"  multiple="true">
      @foreach($pecas as $peca) <!-- aqui o retorno é o id da peça -->
            <option value="{{$peca->id}}">{{ $peca->nome }} |  {{ $peca->valor_venda }}</option>
      @endforeach 
    </select>
  </div>
</div>
    
