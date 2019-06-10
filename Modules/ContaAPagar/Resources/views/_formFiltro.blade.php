
        Categoria
<div class="form-group col-md-3">

            <select id="inputState" class="form-control" name="categoria_id" required>
                <option value="todas">Todas opções</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
            @endforeach
        </select>
            </div>
        Data inicial
    <div class="col-md-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    date_range
                </i>
            </div>
                <input type="date" class="form-control" placeholder="Pagamento" aria-label="dataVencimento"
                aria-describedby="basic-addon1", name="data_inicial" value="{{date('Y-m-01')}}" required>
        </div>
            </div>
        Data final
            <div class="col-md-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <i class="material-icons input-group-text" id="basic-addon1">
                    date_range
                </i>
            </div>
                <input type="date" class="form-control" placeholder="Pagamento" aria-label="dataVencimento"
                aria-describedby="basic-addon1", name="data_final" value="{{date('Y-m-t')}}" required>
        </div>
            </div>
        <div class="col-md-1">
            <button type="submit" class="align-self-end btn btn-primary" >Filtrar</button>
            </div>