
<div class="input-group justify-content-center">
  <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
    Selecionar peça
  </button>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Selecionar peça</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

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
                    <td scope="row"> {{$peca->nome }} </td>
                    <td> R$ {{$peca->valor_venda }} </td>
                    <td>
                      <a href="{{route('consertos.peca.selecionar', $id , $pecas, $servicos, $peca->id)}}"><button type="button" class="btn">Selecionar</button></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </div>
          </table>
        </div>

      </div>
        <div class="modal-footer">
          >(mudar pagina)
        </div>
      </div>
    </div>
  </div>

aqui vai mostrar oq escolher
