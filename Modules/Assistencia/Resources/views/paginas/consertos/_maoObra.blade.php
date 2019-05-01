<div class="input-group">
  <input type="text" class="form-control col-sm-10" name="busca" placeholder="Pesquisar peça" aria-label="Pesquisar peça" aria-describedby="button-addon2">
  <div class="input-group-append">
    <input class="btn btn-outline-secondary" type="submit" value="Pesquisar" id="button-addon2"></input>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-borderless">
    <div class="row">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Valor unitário</th>
        </tr>
      </thead>
    </div>
    <div class="row">
      <tbody>
        @foreach ($servicos as $servico)
          <tr>
            <td scope="row">{{$servico->nome }}</td>
            <td>R$ {{$servico->valor }}</td>
            <td>
              <a href="{{route('consertos.servicos.retirar',$servico->id)}}"><button type="button" class="btn"><i class="material-icons">clear</i></button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </div>

  </table>
</div>
