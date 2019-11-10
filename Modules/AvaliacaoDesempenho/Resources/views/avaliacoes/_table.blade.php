<table id='table' class='table table-hover table-bordered'>

  <thead>

    <tr>

      <th class="text-center">Nome</th>

      <th class="text-center">Processo</th>

      <th class="text-center">Responsavel</th>

      <th class="text-center">Setor</th>

      <th class="text-center">Tipo Avaliação</th>

      <th class="text-center">Status</th>

      <th class="text-center">Ações</th>

    </tr>

  </thead>

  <tbody>

    @if ($result->count())

    @foreach($result as $avaliacao)

    <tr class="{{ !empty($avaliacao->deleted_at) ? 'table-inactive' : '' }}">

      <td class="text-center align-middle">{{ $avaliacao->nome }}</td>

      <td class="text-center align-middle">{{ $avaliacao->processo->nome }}</td>

      <td class="text-center align-middle">{{ $avaliacao->responsavel->nome }}</td>

      <td class="text-center align-middle">{{ $avaliacao->setor->nome }}</td>

      <td class="text-center align-middle">{{ $avaliacao->tipo->nome }}</td>

      <td class="text-center align-middle">{{ $avaliacao->status->nome }}</td>

      <td class="text-center align-middle acoes">

        <a class="btn btn-info acoes-btn" title="Show"
          href="/tcc/public/avaliacaodesempenho/avaliacao/{{ $avaliacao->id }}/show"><i
            class="material-icons md-18 md-light">search</i></a>

        <a class="btn btn-warning btn-edit acoes-btn {{ !empty($avaliacao->deleted_at) || $avaliacao->status->id != 1 ? 'disabled' : '' }}"
          title="Editar" href="/tcc/public/avaliacaodesempenho/avaliacao/{{ $avaliacao->id }}/edit"><i
            class="material-icons md-18 md-light">edit</i></a>

        <form action="{{ url('avaliacaodesempenho/avaliacao', [$avaliacao->id]) }}" id="deleteForm_{{$avaliacao->id}}"
          method="POST">
          @method('DELETE')
          {{ csrf_field() }}
          @if (empty($avaliacao->deleted_at))

          <button class="btn btn-danger acoes-btn" type="button" id="btn-delete" title="Desativar"
            onclick="confirmDelete({{$avaliacao->id}}, 'Deseja desativar a Avaliação?')"><i
              class="material-icons md-18">close</i></button>

          @else

          <button class="btn btn-success acoes-btn" type="button" id="btn-delete" title="Ativar"
            onclick="confirmDelete({{$avaliacao->id}}, 'Deseja ativar a Avaliação?')"><i
              class="material-icons md-18">restore_from_trash</i></button>

          @endif
        </form>

      </td>

    </tr>

    @endforeach

    @endif

  </tbody>

</table>
