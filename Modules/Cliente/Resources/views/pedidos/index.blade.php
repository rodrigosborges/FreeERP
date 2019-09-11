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
                  <th>Id_Compra</th>
                  <th>Num_Compra</th>
                  <th>Data</th>
                  <th>Valor Liquido</th>
                  <th>Desconto Aplicado</th>
                  <th>Opções</th>
                  <th>Ver mais</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cliente->pedidos as $pedido)
                <tr>
                     <th scope="row">{{$pedido->id}}</th>
                        <td>{{$pedido->numero}}</td>
                        <td>{{ \Carbon\Carbon::parse($pedido->data)->format('d/m/Y') }}</td>
                        <td>{{"R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}</td>
                        <td>{{ ($pedido->desconto). "%" }}</td>
                        <td><!--BOTOES -->
                          <div class="flex row justify-content-around">
                                 <a href="{{url("/cliente/pedido/".$pedido->id )}}" 
                                  class="btn btn-sm btn-warning" name="edit">Editar</button>
                                 </a>
                              <form action={{url( "/cliente/pedido/".$pedido->id ) }} method="post" onsubmit="return confirmar({{$pedido->id}});">
                                  {{method_field('DELETE')}}
                                  {{ csrf_field() }}
                                  <button type="submit" class="btn btn-sm btn-danger" name="rem">Excluir</button>
                              </form>

                          </div>
                        </td>

                        <td>
                            <button id="ocultar" type="button" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" 
                        aria-expanded="false" aria-controls="collapse{{$pedido->id}}">
                                    <i class="material-icons">
                                        arrow_drop_down
                                    </i>
                            </button>
                        </td>
                </tr>
              

                <tr>
                  <td colspan="100%" style="height: 0px; padding: 0px; margin:0px;">
                    <div class="collapse" id="collapse{{$pedido->id}}">
                       <div class="row d-flex justify-content-between">

                          @forelse ($pedido->vl_total_itens() as $item)
                              <div class = "col-6 pt-1">
                                <table class="table table-sm bordered">
                                  <thead>
                                    <th scope="col" class="table-light">Produto</th>
                                    <th scope="col" class="table-light">Quantidade</th>
                                    <th scope="col" class="table-light">Valor Item</th>
                                    <th scope="col" class="table-light">Desconto Item</th>
                                    <th scope="col" class="table-light">Total</th>
                                    
                                  </thead>
                                  <tbody>
                                    <td>{{ $item->nome }}</td>
                                    <td>{{$item->quantidade}}</td>
                                    <td >{{ "R$ ".number_format($item->preco, 2, ',', '.') }}</td>
                                    <td>{{ $item->desconto." %"}}</td>
                                    <td>{{ "R$ ".number_format($item->valor_total, 2, ',', '.')}}</td>
                                </tbody>
                                </table>
                              
                              </div>
                              @empty
                              <div class = "col-6 pt-1">
                                  <h5>Compra sem itens cadastrados</h5>
                              </div>
                          @endforelse
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
    function confirmar(pedido_id){
      confirmado = confirm("Deseja mesmo excluir pedido id: " +pedido_id+" ?");
      return confirmado;
      
      
    }

  </script>

@endsection

