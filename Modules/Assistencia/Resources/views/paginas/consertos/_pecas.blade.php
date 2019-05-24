
  <div class="form-group row">
    <div class="col-12 multi-select">
      <select name="pecas[]" class="form-control col-12 " multiple="multiple">

        @foreach($pecas as $peca)
     
          <option value="{{ $peca->id }}"> {{ $peca->nome }} . "  | " . {{ $peca->valor_venda }}</option>

        @endforeach 

      </select>
    </div>
    
  </div>

  <select class="js-example-basic-multiple js-states form-control " id="id_label_multiple" multiple="multiple">
    
    @foreach($pecas as $peca)
     
          <option value="{{ $peca->id }}"> {{ $peca->nome }} . "  | " . {{ $peca->valor_venda }}</option>

    @endforeach 

  </select>