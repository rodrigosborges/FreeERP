<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">person</i></span>
    </div>
    <input class="form-control" name="nome" type="text" placeholder="Nome da peça" value="{{isset($peca->nome) ? $peca->nome : old('nome', '')}}">

    <div class="col-12">
      <span class="errors"> {{ $errors->first('nome') }} </span>
    </div>
  </div>

</div>
<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">money_off</i></span>
    </div>
    <input class="form-control" name="valor_compra" type="text" id="money1" placeholder="Valor da compra" value="{{isset($peca->valor_compra) ? $peca->valor_compra : old('valor_compra', '')}}">
    <div class="col-12">
      <span class="errors"> {{ $errors->first('valor_compra') }} </span>
    </div>
  </div>

</div>
<div class="form-group">
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text" id="cliente"><i class="material-icons">attach_money</i></span>
    </div>
    <input class="form-control" name="valor_venda" type="text" id="money2" placeholder="Valor para venda" value="{{isset($peca->valor_venda) ? $peca->valor_venda : old('valor_venda', '')}}">
    <div class="col-12">
      <span class="errors"> {{ $errors->first('valor_venda') }} </span>
    </div>
  </div>

</div>
<div class="form-group col-12">
  <input class="form-control" id="qnt" name="quantidade" type="text" maxlength="2" placeholder="Quantidade" disabled value="{{isset($peca->quantidade) ? $peca->quantidade : old('quantidade', '')}}">
</div>
<div class="card">
  <div class="card-body">
  <div class="table-responsive">
        <table class="table table-striped">
          <div class="row">
            <thead>
              <tr>
                <th scope="col">Identificação</th>
                <th scope="col">Ações</th>
              </tr>

            </thead>
          </div>
          <div class="row">
            <tbody>
              @foreach ($itens as $item)
                <tr>
                  <td scope="row">{{$item->id }}</td>
                  <td>
                    <a href="{{route('itemPeca.deletar',$item->id)}}"><button type="button" class="btn btn-danger">Deletar</button></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <td colspan="100%" class="text-center">
                  <p class="text-center">
                      Página {{$itens->currentPage()}} de {{$itens->lastPage()}} páginas
                      
                  </p>
                  </td>
              </tr>
              @if($itens->lastPage() > 1)
              <tr>
                  <td colspan="100%">
                      {{ $itens->links() }}
                  </td>
              </tr>
              @endif
          </tfoot>
          </div>
        </table>
      </div>
  </div>
</div>


