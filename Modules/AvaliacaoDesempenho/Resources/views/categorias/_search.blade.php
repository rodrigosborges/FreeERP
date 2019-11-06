<form action="" id="SearchForm" class="search-form col-md-12" method="POST">
    {{ csrf_field() }}
    
    <div class="form-row">
    
        <div class="form-group col-md-7">
    
            <div class="input-group">
    
                <div class="input-group-prepend">
    
                    <span class="input-group-text">
                        <i class="material-icons">find_in_page</i>
                    </span>

                </div>
                    
                <input type="text" class="form-control" name="_nome" placeholder="Busque por Nome">
    
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