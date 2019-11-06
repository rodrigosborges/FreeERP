<table id='table' class='table table-hover table-bordered'>

    <thead>
  
      <tr>
  
        <th class="text-center">Nome</th>
  
        <th class="text-center">Status</th>
  
        <th class="text-center">Ações</th>
  
      </tr>
  
    </thead>
  
    <tbody>

      @if ($result->count())
  
        @foreach($result as $categoria)
    
          <tr class="{{ !empty($categoria->deleted_at) ? 'table-inactive' : '' }}">
    
            <td class="text-center align-middle">{{ $categoria->nome }}</td>
    
            <td class="text-center align-middle">{{ is_null($categoria->deleted_at) ? 'Ativo' : 'Inativo' }}</td>
    
            <td class="text-center align-middle acoes">
    
              <a class="btn btn-warning btn-edit acoes-btn {{ !empty($categoria->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/categoria/{{ $categoria->id }}/edit"><i class="material-icons md-18 md-light">edit</i></a>
                
              <form action="{{ url('avaliacaodesempenho/categoria', [$categoria->id]) }}" id="deleteForm_{{$categoria->id}}" method="POST">
                @method('DELETE')
                {{ csrf_field() }}
                @if (empty($categoria->deleted_at))
      
                  <button class="btn btn-danger acoes-btn" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$categoria->id}}, 'Deseja desativar a Categoria?')"><i class="material-icons md-18">close</i></button>
      
                @else
      
                  <button class="btn btn-success acoes-btn" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$categoria->id}}, 'Deseja ativar a Categoria?')"><i class="material-icons md-18">restore_from_trash</i></button>
      
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
  