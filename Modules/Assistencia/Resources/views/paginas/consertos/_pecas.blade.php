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
        @foreach ($pecas as $peca)
          <tr>
            <td scope="row">{{$peca->nome }}</td>
            <td>R$ {{$peca->valor_venda }}</td>
            <td>
              <a href="{{route('consertos.peca.retirar',$peca->id)}}"><button type="button" class="btn"><i class="material-icons">clear</i></button></a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </div>

  </table>
</div>
