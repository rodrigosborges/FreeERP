<div class="row">
    
    <div class="col-md-8">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    sort
                </i>
            </div>
            <input type="text" class="form-control" placeholder="Descrição" aria-label="descricao"
                aria-describedby="basic-addon1" name="descricao" value="{{ isset($conta->descricao) ? $conta->descricao : old('descricao', '') }}" required>
        </div>
    </div>

    <div class="form-group col-md-4">
        <select id="inputState" class="form-control" name="categoria_pagar_id" required>
            @foreach ($categorias as $categoria)
        <option value="{{$categoria->id}}" {{ isset($conta->categoria_pagar_id) && $categoria->id == $conta->categoria_pagar_id ? 'selected' : '' }}>{{$categoria->nome}}</option>
            @endforeach
        </select>
    </div>


    <div class="col-md-4">
        Valor
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    attach_money
                </i>
            </div>
            <input type="number" class="form-control" placeholder="100.00"
                aria-describedby="basic-addon1" name="valor" min="1" step="any" value="{{ isset($conta->valor) ? $conta->valor : old('valor', '') }}" required>
        </div>
    </div>

    <div class="col-md-2">
        Parcelas
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    sort
                </i>
            </div>
            <input type="text" class="form-control" placeholder="1"
                aria-describedby="basic-addon1" name="parcelas" value="{{ isset($conta->parcelas) ? $conta->parcelas : old('parcelas', '') }}" readonly required>
        </div>
    </div>

        
    <div class="form-group col-md-2">
        <button class="btn btn-primary">Salvar</button>
    </div>
</div>



