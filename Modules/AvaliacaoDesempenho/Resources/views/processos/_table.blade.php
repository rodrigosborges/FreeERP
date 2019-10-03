<table class="table table-bordered table-hover">

    <thead>
  
      <tr>
  
        <th class="text-center">#</th>
  
        <th class="text-center">Responsavel</th>
  
        <th class="text-center">Data Inicio</th>
  
        <th class="text-center">Data Fim</th>
  
        <th class="text-center">Status</th>
  
        <th class="text-center">Ações</th>
  
      </tr>
  
    </thead>
  
    <tbody>
  
      @foreach($processos as $processo)
  
        <tr class="{{ !empty($processo->deleted_at) ? 'table-inactive' : '' }}">
  
          <td class="text-center align-middle">{{ $processo->id }}</td>
  
          <td class="text-center align-middle">{{ $processo->responsavel->nome }}</td>
  
          <td class="text-center align-middle">{{ $processo->data_inicio }}</td>

          <td class="text-center align-middle">{{ $processo->data_fim }}</td>
  
          <td class="text-center align-middle">{{ is_null($processo->deleted_at) ? 'Ativado' : 'Desativado' }}</td>
  
          <td class="text-center align-middle">
  
            <a class="btn btn-warning btn-edit {{ !empty($processo->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/processo/{{ $processo->id }}/edit"><i class="material-icons md-14 md-light">edit</i></a>
              
            <form action="{{ url('avaliacaodesempenho/processo', [$processo->id]) }}" id="deleteForm_{{$processo->id}}" method="POST">
              @method('DELETE')
              {{ csrf_field() }}
              @if (empty($processo->deleted_at))
    
                <button class="btn btn-danger" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$processo->id}}, 'Deseja desativar o Processo?')"><i class="material-icons md-14">close</i></button>
    
              @else
    
                <button class="btn btn-success" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$processo->id}}, 'Deseja ativar o Processo?')"><i class="material-icons md-14">restore_from_trash</i></button>
    
              @endif
            </form>
  
          </td>
  
        </tr>
  
      @endforeach
  
    </tbody>
  
  </table>
  