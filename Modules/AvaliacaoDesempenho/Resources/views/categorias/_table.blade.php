<table class="table table-bordered table-hover">

    <thead>
  
      <tr>
  
        <th class="text-center">#</th>
  
        <th class="text-center">Nome</th>
  
        <th class="text-center">Status</th>
  
        <th class="text-center">Ações</th>
  
      </tr>
  
    </thead>
  
    <tbody>

      @if ($categorias->count())
  
        @foreach($categorias as $categoria)
    
          <tr class="{{ !empty($categoria->deleted_at) ? 'table-inactive' : '' }}">
    
            <td class="text-center align-middle">{{ $categoria->id }}</td>
    
            <td class="text-center align-middle">{{ $categoria->nome }}</td>
    
            <td class="text-center align-middle">{{ is_null($categoria->deleted_at) ? 'Ativo' : 'Inativo' }}</td>
    
            <td class="text-center align-middle">
    
              <a class="btn btn-warning btn-edit {{ !empty($categoria->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/categoria/{{ $categoria->id }}/edit"><i class="material-icons md-14 md-light">edit</i></a>
                
              <form action="{{ url('avaliacaodesempenho/categoria', [$categoria->id]) }}" id="deleteForm_{{$categoria->id}}" method="POST">
                @method('DELETE')
                {{ csrf_field() }}
                @if (empty($categoria->deleted_at))
      
                  <button class="btn btn-danger" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$categoria->id}}, 'Deseja desativar a Categoria?')"><i class="material-icons md-14">close</i></button>
      
                @else
      
                  <button class="btn btn-success" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$categoria->id}}, 'Deseja ativar a Categoria?')"><i class="material-icons md-14">restore_from_trash</i></button>
      
                @endif
              </form>
    
            </td>
    
          </tr>
    
        @endforeach
      
      @else
    
        <div class="alert alert-warning">Não foram encontrados registros.</div>

      @endif
  
    </tbody>
  
  </table>
  