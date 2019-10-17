<div class="table-responsive">

<table class="table" id="tablePedidos">
    <thead>
        <tr>
            <th>Número</th>
            <th>Data</th>
            <th>Valor dos Itens</th>
            <th>Valor do Pedido</th>
            <th>Desconto do Pedido</th>
            <th>Opções</th>
            <th>Ver mais</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($pedidos as $pedido)
        <!-- Modal -->
        <div class="modal fade" id="modal{{$pedido->id}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Itens do pedido {{ $pedido->numero }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group p-3">
                            <li class="list-group-item bg-light">
                                <div class="row">
                                    <div class="col">Produto</div>
                                    <div class="col">Quantidade</div>
                                    <div class="col">Preço Unitário</div>
                                    <div class="col">Desconto</div>
                                    <div class="col">Valor Total</div>
                                </div>
                            </li>

                            @forelse ($pedido->vl_total_itens() as $item)

                            <li class="list-group-item">
                                <div class="row">

                                    <div class="col">{{ $item->nome }}</div>
                                    <div class="col">{{$item->quantidade}}</div>
                                    <div class="col">{{ "R$ ".number_format($item->preco, 2, ',', '.') }}</div>
                                    <div class="col">{{ $item->desconto." %"}}</div>
                                    <div class="col">{{ "R$ ".number_format($item->valor_total, 2, ',', '.')}}</div>

                                </div>

                            </li>

                            @empty
                            <div class="pt-1 text-center">
                                <h5>Compra sem item cadastrado</h5>
                            </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <tr>
            <td>{{$pedido->numero}}</td>
            <td name="dtPedido">{{ $pedido->data }}</td>
            <td>{{ "R$ ".number_format($pedido->vl_itens_desconto(), 2, ',', '.') }}</td>
            <td>{{ "R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}</td>
            <td>{{ ($pedido->desconto). "%" }}</td>
            
            <td>
            <div class="flex row justify-content-around">
                @if($pedido->trashed())
                
                  {{-- Restaurar pedido apagado --}}
                  {!! Form::open(['method' => 'DELETE','route' => ['delete.pedido', $pedido->id] ]) !!}
                  <button type="submit" class="btn btn-sm btn-success" name="restaurar">Restaurar</button>
                  {!! Form::close() !!}
               
                @else
                
                    {{-- Editar pedido --}}
                    <a href="{{ url( "/cliente/pedido/".$pedido->id )}}" class="btn btn-sm btn-outline-info"
                        name="edit">Editar</button>
                    </a>
                    {{-- BOTAO PARA EXCLUSAO DO ITEM INDIVIDUALMENTE --}}
                    {!! Form::open(['method' => 'DELETE','route' => ['delete.pedido', $pedido->id] ]) !!}
                    <button type="submit" class="btn btn-sm btn-danger" name="delete">Excluir</button>
                    {!! Form::close() !!}
                
                @endif
                </div>
            </td>

            <td class="text-center">
                <button class="btn btn-sm btn-light" id="ocultar" type="button" data-toggle="modal"
                    data-target="#modal{{$pedido->id}}" aria-expanded="false" aria-controls="collapse{{$pedido->id}}">
                    <i class="material-icons">
                        more_horiz
                    </i>
                </button>
            </td>

            
        </tr>
        {{-- Tabela detalhando --}}
        <tr>
            <td colspan="100%" style="height: 0px; padding: 0px; margin:0px;">
                <div class="collapse" id="collapse{{$pedido->id}}">
                    <div class="row d-flex justify-content-between">


                    </div>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
            <tr>
                <td colspan="100%" class="text-center">
                    <p class="text-center">
                        {{$pedidos->currentPage()}} de {{$pedidos->lastPage()}}
                        páginas
                    </p>
                </td>
            </tr>
            @if($pedidos->lastPage() > 1)
            <tr>
                <td colspan="100%">
                    {{ $pedidos->links() }}
                </td>
            </tr>
            @endif
        </tfoot>
</table>
</div>