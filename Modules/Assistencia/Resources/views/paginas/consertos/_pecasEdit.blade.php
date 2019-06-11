<div class="row form-group">
  <div class="col-12 ">
  <label for="">Selecione as peças</label>
    <select style="width:100%;" name="pecas[]" id="valor_peca" class="form-control multi-select"  multiple="true">
      	@foreach($pecas as $peca) 

          @foreach($itemPeca as $item)
            <?php 
            $pecaId = $item->idPeca;
            ?>
            @if ($pecaId == $peca->id)
              <option data-valor="{{$peca->valor_venda}}" selected value="{{ $peca->id }}">{{ $peca->nome }} |  {{ $peca->valor_venda }}</option>
              @break
            @else
              <option data-valor="{{$peca->valor_venda}}" value="{{ $peca->id }}">{{ $peca->nome }} |  {{ $peca->valor_venda }}</option>
              @break
            @endif
            
          @endforeach

   		
   		@endforeach
    </select>
  </div>
</div>

        