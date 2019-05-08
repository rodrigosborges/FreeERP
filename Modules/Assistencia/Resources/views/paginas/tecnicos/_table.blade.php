<div class="table-responsive">
  <table id="tabela" class="table table-striped">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
        </tr>

      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($tecnicos as $tecnico)
          <tr>
            <td scope="row">{{$tecnico->nome }}</td>
            <td>{{$tecnico->cpf }}</td>
            <td>
              <a href="{{route('tecnico.editar',$tecnico->id)}}"><button type="button" class="btn btn-secondary">Editar</button></a>
              <a href="{{route('tecnico.deletar',$tecnico->id)}}"><button type="button" class="btn btn-danger">Deletar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </div>
  </table>
</div>
