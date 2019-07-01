<div class="row">
    
    <div class="col-md-5">
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

    <div class="form-group col-md-3">
        <select id="inputState" class="form-control" name="forma_pagamento_id" required>
            <option value="" selected disable>-- Forma de pagamento -- </option>
            @foreach ($formapgs as $formapg)
        <option value="{{$formapg->id}}">{{$formapg->nome}}</option>
            @endforeach
        </select>
    </div>    
    
    <div class="form-group col-md-3">
        <select id="inputState" class="form-control" name="categoria_receber_id" required>
            <option value="" selected disable>-- Categoria --</option>
            @foreach ($categorias as $categoria)
        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        Data de Pagamento
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    date_range
                </i>
            </div>
                <input type="date" class="form-control" placeholder="Pagamento" aria-label="dataVencimento"
                aria-describedby="basic-addon1", name="data_pagamento" value="{{ isset($conta->data_pagamento) ? $conta->data_pagamento : old('data_pagamento', '10-10-2000') }}" required>
        </div>
    </div>

    <div class="col-md-4">
        Valor
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    attach_money
                </i>
            </div>
            <input type="number" min="1" step="any" class="form-control" placeholder="100.00"
                aria-describedby="basic-addon1" name="valor" value="{{ isset($conta->valor) ? $conta->valor : old('valor', '') }}" required>
        </div>
    </div>


    <div class="col-md-10">
        Status do Pagamento
        <div class="form-check form-group">
            <input name="status_pagamento" value="0" type="hidden">
            <input class="form-check-input" type="checkbox" name="status_pagamento" id="gridCheck1">
            <label class="form-check-label" for="gridCheck1">
            Conta Paga
            </label>
        </div>
    </div>
        
    <div class="form-group col-md-2">
        <button class="btn btn-primary">Salvar</button>
    </div>
</div>



