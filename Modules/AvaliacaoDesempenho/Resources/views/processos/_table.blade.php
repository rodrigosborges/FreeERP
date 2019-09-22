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
  
          <td class="text-center align-middle">{{ $processo->funcionario_id }}</td>
  
          <td class="text-center align-middle">{{ $processo->data_inicio }}</td>

          <td class="text-center align-middle">{{ $processo->data_fim }}</td>
  
          <td class="text-center align-middle">{{ is_null($processo->deleted_at) ? 'Ativado' : 'Desativado' }}</td>
  
          <td class="text-center align-middle">
  
          <a class="btn btn-warning btn-edit {{ !empty($processo->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/processos/edit/{{ $processo->id }}"><i class="fas fa-pencil-alt"></i></a>
  
            @if (empty($processo->deleted_at))
  
              <button class="btn btn-danger" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{ $processo->id }},'Deseja desativar o Processo?','destroy')"><i class="fas fa-trash-alt fa-fw"></i></button>
  
            @else
  
              <button class="btn btn-success" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{ $processo->id }},'Deseja ativar o Processo?','restore')"><i class="fas fa-recycle fa-fw"></i></button>
  
            @endif
  
          </td>
  
        </tr>
  
      @endforeach
  
    </tbody>
  
  </table>
  