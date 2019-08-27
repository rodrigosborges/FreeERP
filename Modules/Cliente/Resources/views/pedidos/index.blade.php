@extends('cliente::template')
@section('title')
Cadastro de Pedidos - {{ $cliente->nome }}
@endsection
@section('body')
<div class = "container border">

      <div id="opcoes" class="row d-flex pt-2 pr-2 justify-content-end">
          <button class="btn btn-primary col-md-3" id="bt_add">Adicionar Compra</button>
      </div>
  
      <div class="row p-2" id="tabela">
          <table class="table table-striped bordered text-center col-md-12">
              <thead>
                <tr>
                  <th >Num_Pedido</th>
                  <th>Data</th>
                  <th>Valor</th>
                  <th>Vl_Desconto</th>
                  <th>Opções</th>
                  <th>Ver mais</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($cliente->pedidos as $pedido)
                <tr>
                    <th scope="row">{{$pedido->id}}</th>
                        <td>{{$pedido->data}}</td>
                        <td>Calcular</td>
                        <td>{{"R$ ".number_format($pedido->desconto,2) }}</td>
                        <td>
                            <button class="btn btn-warning col-md-5" id="edit">Editar</button>
                            <button class="btn btn-danger col-md-5" id="rem">Excluir</button>
                        </td>
                        <td>
                            <button id="ocultar"  data-toggle="collapse" href="#collapseExample" 
                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="material-icons">
                                        arrow_drop_down
                                    </i>
                            </button>
                        </td>
                        
                </tr>
                @endforeach 
                
              </tbody>
            </table>
      </div>
  </div>
  <script>
    function ocultar(){
      document.getElementById("oculta").css('color','red');
    }
  
  
  </script>

@endsection

