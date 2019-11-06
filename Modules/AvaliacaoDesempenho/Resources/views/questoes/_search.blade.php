<form action="" id="SearchForm" class="search-form col-md-12" method="POST">
    {{ csrf_field() }}

    <div class="form-row">

        <div class="form-group col-md-12">
    
            <div class="input-group">
    
                <div class="input-group-prepend">
    
                    <span class="input-group-text">
                        <i class="material-icons">subject</i>
                    </span>
    
                </div>
                
                <input type="text" class="form-control" name="_enunciado" placeholder="Busque por Enunciado">                    
    
            </div>
    
        </div>

    </div>
    
    <div class="form-row">
    
        <div class="form-group col-md-7">
    
            <div class="input-group">
    
                <div class="input-group-prepend">
    
                    <span class="input-group-text">
                        <i class="material-icons">list</i>
                    </span>

                </div>
                    
                <select name="_categoria" id="_categoria" class="form-control">
                    <option value="">Busque por Categoria</option>
                    @foreach ($data['categorias'] as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>                        
                    @endforeach
                </select>
    
            </div>
    
        </div>

        <div class="form-group col-md-4">
    
            <div class="input-group">
    
                <div class="input-group-prepend">
    
                    <span class="input-group-text">
                        <i class="material-icons">style</i>
                    </span>
    
                </div>
                
                <select name="_status" id="_status" class="form-control">
                    <option value="">Busque por Status</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
    
            </div>
    
        </div>
        
        <div class="col-md-1">
            <button type="button" class="btn btn-success submit-btn" id="submit-btn">Buscar</button>
        </div>

    </div>

</form>