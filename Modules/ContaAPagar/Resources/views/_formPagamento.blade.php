<div class="row">
    
    <div class="col-md-4">
        Data de Pagamento
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    date_range
                </i>
            </div>
                <input type="date" class="form-control" placeholder="Pagamento" aria-label="dataVencimento"
                aria-describedby="basic-addon1", name="data_pagamento" value="{{ isset($pagamento->data_pagamento) ? $pagamento->data_pagamento : old('data_pagamento', '10-10-2000') }}">
        </div>
    </div>

    <div class="col-md-4">
        Data de Vencimento
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    date_range
                </i>
            </div>
            <input type="date" class="form-control" placeholder="Vencimento" aria-label="dataVencimento"
                aria-describedby="basic-addon1" name="data_vencimento" value="{{ isset($pagamento->data_vencimento) ? $pagamento->data_vencimento : old('data_vencimento', '10-10-2000') }}">
        </div>
    </div>
    <div class="col-md-4">
        Valor da parcela
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    attach_money
                </i>
            </div>
            <input type="text" class="form-control" placeholder="100.00"
                aria-describedby="basic-addon1" name="valor" value="{{ isset($pagamento->valor) ? $pagamento->valor : old('valor', '') }}">
        </div>
    </div>

    <div class="col-md-3">
        Juros
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    attach_money
                </i>
            </div>
            <input type="text" class="form-control" placeholder="0.00"
                aria-describedby="basic-addon1" name="juros" value="{{ isset($pagamento->juros) ? $pagamento->juros : old('juros', '') }}">
        </div>
    </div>

    <div class="col-md-3">
        Multa
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    attach_money
                </i>
            </div>
            <input type="text" class="form-control" placeholder="0.00"
                aria-describedby="basic-addon1" name="multa" value="{{ isset($pagamento->multa) ? $pagamento->multa : old('multa', '') }}">
        </div>
    </div>

    <div class="col-md-2">
    Conta Paga?
        <div class="form-check form-group">
            <input name="status_pagamento" value="0" type="hidden" >
            <input class="form-check-input" type="checkbox" name="status_pagamento" id="gridCheck1" {{isset($pagamento->status_pagamento) && $pagamento->status_pagamento == 'Pago' ? 'checked' : ''}}>
            <label class="form-check-label" for="gridCheck1">
            
            </label>
        </div>
    </div>
        

</div>



