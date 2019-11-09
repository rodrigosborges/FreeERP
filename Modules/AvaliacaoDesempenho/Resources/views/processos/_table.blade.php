<table id='table' class='table table-hover table-bordered'>

    <thead>

      <tr>

        <th class="text-center">Nome</th>

        <th class="text-center">Responsavel</th>

        <th class="text-center">Data Inicio</th>

        <th class="text-center">Data Fim</th>

        <th class="text-center">Status</th>

        <th class="text-center">Ações</th>

      </tr>

    </thead>

    <tbody>

      @if ($result->count())

        @foreach($result as $processo)

          <tr class="{{ !empty($processo->deleted_at) ? 'table-inactive' : '' }}">

            <td class="text-center align-middle">{{ $processo->nome }}</td>

            <td class="text-center align-middle">{{ $processo->responsavel->nome }}</td>

            <td class="text-center align-middle">{{ $processo->data_inicio }}</td>

            <td class="text-center align-middle">{{ $processo->data_fim }}</td>

            <td class="text-center align-middle">{{ $processo->status->nome }}</td>

            <td class="text-center align-middle acoes">

              <a class="btn btn-warning btn-edit acoes-btn {{ !empty($processo->deleted_at) ? 'disabled' : '' }}" title="Editar" href="/tcc/public/avaliacaodesempenho/processo/{{ $processo->id }}/edit"><i class="material-icons md-18 md-light">edit</i></a>

              <form action="{{ url('avaliacaodesempenho/processo', [$processo->id]) }}" id="deleteForm_{{$processo->id}}" method="POST">
                @method('DELETE')
                {{ csrf_field() }}
                @if (empty($processo->deleted_at))

                  <button class="btn btn-danger acoes-btn" type="button" id="btn-delete" title="Desativar" onclick="confirmDelete({{$processo->id}}, 'Deseja desativar o Processo?')"><i class="material-icons md-18">close</i></button>

                @else

                  <button class="btn btn-success acoes-btn" type="button" id="btn-delete" title="Ativar" onclick="confirmDelete({{$processo->id}}, 'Deseja ativar o Processo?')"><i class="material-icons md-18">restore_from_trash</i></button>

                @endif
              </form>

            </td>

          </tr>

        @endforeach

      @endif

    </tbody>

  </table>
