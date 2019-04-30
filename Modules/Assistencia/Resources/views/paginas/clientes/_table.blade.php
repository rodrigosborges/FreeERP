<div class="table-responsive">
  <table id="tabela" class="table table-striped">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
          <th scope="col">Nascimento</th>
          <th scope="col">Celular</th>
          <th scope="col">Telefone</th>
          <th scope="col">Ações</th>
        </tr>

      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($clientes as $cliente)
          <tr>
            <td scope="row">{{$cliente->nome }}</td>
            <td>{{$cliente->cpf }}</td>
            <td>{{$cliente->data_nascimento }}</td>
            <td>{{$cliente->celnumero }}</td>
            <td>{{$cliente->telefonenumero }}</td>
            <td>
              <a href="{{route('cliente.editar',$cliente->id)}}"><button type="button" class="btn btn-secondary">Editar</button></a>
              <a href="{{route('cliente.deletar',$cliente->id)}}"><button type="button" class="btn btn-danger">Deletar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </div>
  </table>
</div>
