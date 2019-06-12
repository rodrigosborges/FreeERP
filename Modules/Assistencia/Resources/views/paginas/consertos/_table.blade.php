<div class="table-responsive">
  <table id="tabela" class="table table-striped">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Numero</th>
          <th scope="col">Cliente</th>
          <th scope="col">Aparelho</th>
          <th scope="col">Valor</th>
        </tr>

      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($consertos as $conserto)
          <tr>
            <td scope="row">{{$conserto->id }}</td>
            <td>{{$conserto->cliente->nome }}</td> 
            <td>{{$conserto->modelo_aparelho }}</td>
            <td>{{ $conserto->valor }}</td>
            <td>
              <a href="{{route('consertos.visualizar', $conserto->id)}}"><button type="button" class="btn btn-secondary">Vizualizar</button></a>
              <a href="{{route('consertos.editar', $conserto->id)}}"><button type="button" class="btn btn-danger">Editar</button></a>
              <a href="{{route('consertos.finalizar', $conserto->id)}}"><button type="button" class="btn btn-warning">Finalizar</button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </div>
  </table>
</div>
