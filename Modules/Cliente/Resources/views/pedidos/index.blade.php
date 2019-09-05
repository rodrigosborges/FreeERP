@extends('cliente::template')
@section('title')
Cadastro de Compras - {{ $cliente->nome }}
@endsection
@section('body')
<div class = "container border">

      <div id="opcoes" class="row d-flex pt-2 pr-2 justify-content-end">
         <a class="btn btn-primary col-md-3" href="/cliente/{{$cliente->id}}/pedido/novo" style="color: white;">Adicionar Compra</a>
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
                        <td>
                          {{"R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}
                        </td>
                        <td>{{ ($pedido->desconto). "%" }}</td>
                        <td>
                            <button class="btn btn-warning col-md-5" id="edit">Editar</button>
                            <button class="btn btn-danger col-md-5" id="rem">Excluir</button>
                        </td>
                        <td>
                            <button id="ocultar" type="button" data-toggle="collapse" href="#collapse{{$pedido->id}}" 
                        role="button" aria-expanded="false" aria-controls="collapse{{$pedido->id}}">
                                    <i class="material-icons">
                                        arrow_drop_down
                                    </i>
                            </button>
                        </td>
                </tr>
                
                <tr>
                  <td colspan="100%" style="height: 0px; padding: 0px; margin:0px;">
                    <div class="collapse" id="collapse{{$pedido->id}}">
                       <div class="pedido_detalhes row d-flex justify-content-between">
                          @foreach ($pedido->vl_total_itens() as $item)
                              <div class = "col-6 pt-1">
                                <table class="table table-sm bordered">
                                  <thead>
                                    <th class="table-light">Produto</th>
                                    <th class="table-light">Quantidade</th>
                                    <th class="table-light">Valor Item</th>
                                    <th class="table-light">Desconto</th>
                                    <th class="table-light">Total</th>
                                    
                                  </thead>
                                  <tbody>
                                    <td scope="row">{{ $item->nome }}</td>
                                    <td>{{$item->quantidade}}</td>
                                    <td >{{ "R$ ".number_format($item->preco, 2, ',', '.') }}</td>
                                    <td>{{ $item->desconto." %"}}</td>
                                    <td>{{ "R$ ".number_format($item->valor_total, 2, ',', '.')}}</td>
                                </tbody>
                                </table>
                              
                              </div>
                          @endforeach
                       </div>
                    </div>
                  </td>
                </tr>

                @endforeach 
                
              </tbody>
            </table>
      </div>
  </div>
  <script>
      function NovoCadastro(IdCliente){
        console.log(IdCliente);
      }
  </script>

@endsection

