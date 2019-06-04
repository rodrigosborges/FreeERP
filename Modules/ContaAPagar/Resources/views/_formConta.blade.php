<div class="row">
        <div class="col-md-2 d-flex justify-content-center align-items-center">
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseInputs" role="button" aria-expanded="false"
                aria-controls="collapseInputs collapseSave">
                +Conta
            </a>
        </div>
        <div class="collapse" id="collapseSave">
            <a class="btn btn-primary" role="button">
                Salvar
            </a>
        </div>
        <div class="col-md-10">
            <div class="collapse" id="collapseInputs">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <i class="material-icons input-group-text" id="basic-addon1">
                                        sort
                                    </i>
                                </div>
                                <input type="text" class="form-control" placeholder="Descrição" aria-label="descricao"
                                    aria-describedby="basic-addon1" name="descricao" value="{{ isset($conta->descricao) ? $conta->descricao : old('descricao', '') }}">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <select id="inputState" class="form-control" name="categoria_pagar_id">
                                @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
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
                                    aria-describedby="basic-addon1" name="data_vencimento">
                            </div>
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
                                    aria-describedby="basic-addon1", name="data_pagamento">
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
                                <input type="text" class="form-control" placeholder="100.00"
                                    aria-describedby="basic-addon1" name="valor">
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
                                    aria-describedby="basic-addon1" name="parcelas">
                            </div>
                        </div>
                        <div class="col-md-2">
                            Juros
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <i class="material-icons input-group-text" id="basic-addon1">
                                        attach_money
                                    </i>
                                </div>
                                <input type="text" class="form-control" placeholder="0.00"
                                    aria-describedby="basic-addon1" name="juros">
                            </div>
                        </div>
                        <div class="col-md-2">
                            Multa
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <i class="material-icons input-group-text" id="basic-addon1">
                                        attach_money
                                    </i>
                                </div>
                                <input type="text" class="form-control" placeholder="0.00"
                                    aria-describedby="basic-addon1" name="multa">
                            </div>
                        </div>
                        <div class="col-md-2">
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
                </div>
            </div>
        </div>
    </div>