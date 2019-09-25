@extends('cliente::template')
@section('title')
Cadastro de Compras - {{ $cliente->nome }}
@endsection
@section('content')
<div class = "card">
    
      <div id="opcoes" class="card-header flex">
      <div class="row col-12"><h3>Compras cliente {{ $cliente->nome }}</h3></div>

          <div class="row input-group justify-content-between">  
              <form class="d-flex form-inline justify-content-between" action="">    
                  <div class="col-4">
                      <label class="mr-sm-2" for="dtInicio">Data Inicial</label>
                        <input type="date" id="dtInicio" class="form-control">
                  </div>
                  <div class="col-4">
                      <label class="mr-sm-2" for="dtFim">Data Final</label>
                        <input type="date" id="dtFim" class="form-control">
                  </div>
                  <div class="col-3 align-self-end">
                    <button class="btn btn-outline-info d-flex" type="submit">
                        <i class="material-icons">
                            search
                        </i> Buscar
                    </button>
                  </div>
              </form>

              <div class="align-self-end text-right">
                  <a class="btn btn-primary" href="/cliente/{{$cliente->id}}/pedido/novo" style="color: white;">Adicionar Compra</a>
              </div>

          </div>
            
      </div>
      
      <ul class="nav nav-tabs justify-content-center" id="tab" role="tablist">
        <li class="nav-item">
           <a class="nav-link active" href="#ativos" data-toggle="tab" id="ativos-tab" data-toggle="tab" 
           role="tab" aria-controls="home" aria-selected="true">Ativos</a>
        </li>
        <li class="nav-item">
           <a class="nav-link" href="#inativos" id="profile-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="profile" aria-selected="false">Inativos</a>
        </li>
      </ul>

      <div class="card-body pt-1">
      <div class="tab-content" id="tabContent">
      <div  id="ativos" class="tab-pane fade show active" role="tabpanel" aria-labelledby="ativos-tab">
          <div class="d-flex col-12 pb-1 justify-content-end">
              <button class="btn btn-danger" id="excluirSelecionados" disabled="">
                   Excluir selecionados
              </button>
          </div>
            <table class="table bordered text-center col-md-12">
              <thead>
                <tr>
                  <th>Id_Compra</th>
                  <th>Num_Compra</th>
                  <th>Data</th>
                  <th>Vl Liquido itens</th>
                  <th>Vl Liquido Pedido</th>
                  <th>Desconto Pedido</th>
                  <th>Opções</th>
                  <th>Ver mais</th>
                  <th>
                       <input type="checkbox" id="selecionaTodos" />
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cliente->pedidos as $pedido)
                <tr>
                     <th scope="row">{{$pedido->id}}</th>
                        <td>{{$pedido->numero}}</td>
                        <td>{{ \Carbon\Carbon::parse($pedido->data)->format('d/m/Y') }}</td>
                        <td>{{ "R$ ".number_format($pedido->vl_itens_desconto(), 2, ',', '.') }}</td>
                        <td>{{ "R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}</td>
                        <td>{{ ($pedido->desconto). "%" }}</td>
                        <td>
                          <div class="flex row justify-content-around">
                            {{-- Editar pedido --}}
                              <a href="{{url("/cliente/pedido/".$pedido->id )}}" 
                                  class="btn btn-sm btn-warning" name="edit">Editar</button>
                              </a>
                              {{-- BOTAO PARA EXCLUSAO DO ITEM INDIVIDUALMENTE --}}
                              {!! Form::open(['method' => 'DELETE','route' => ['delete.pedido', $pedido->id] ]) !!}
                                  <button type="submit" class="btn btn-sm btn-danger" name="delete">Excluir</button>
                              {!! Form::close() !!}
                          </div>
                        </td>

                        <td>
                            <button class="btn btn-sm btn-light" id="ocultar" type="button" data-toggle="collapse" data-target="#collapse{{$pedido->id}}" 
                                  aria-expanded="false" aria-controls="collapse{{$pedido->id}}">
                                    <i class="material-icons">
                                        arrow_drop_down
                                    </i>
                            </button>
                        </td>
                        <td>
                            <input type="checkbox" name="selecionado" value="{{$pedido->id}}">
                        </td>
                </tr>
              {{-- checkbox individual acima --}}
                <tr>
                  <td colspan="100%" style="height: 0px; padding: 0px; margin:0px;">
                    <div class="collapse" id="collapse{{$pedido->id}}">
                       <div class="row d-flex justify-content-between">

                          @forelse ($pedido->vl_total_itens() as $item)
                              <div class = "col-6 pt-1">
                                <table class="table table-sm table-borderless">
                                    <thead>
                                      <tr>
                                        <th class="table-light">Produto</th>
                                        <th class="table-light">Quantidade</th>
                                        <th class="table-light">Valor Item</th>
                                        <th class="table-light">Desconto Item</th>
                                        <th class="table-light">Total</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>{{ $item->nome }}</td>
                                        <td>{{$item->quantidade}}</td>
                                        <td >{{ "R$ ".number_format($item->preco, 2, ',', '.') }}</td>
                                        <td>{{ $item->desconto." %"}}</td>
                                        <td>{{ "R$ ".number_format($item->valor_total, 2, ',', '.')}}</td>
                                      </tr>
                                    </tbody>
                                </table>
                              
                              </div>
                              @empty
                              <div class = "col-6 pt-1 text-center">
                                  <h5>Compra sem item cadastrado</h5>
                              </div>
                          @endforelse
                       </div>
                    </div>
                  </td>
                </tr>
                @endforeach 
               
              </tbody>
            </table>
      </div><!--Final tabela e div -->

      <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="profile-tab">
         
      
          
          <table class="table bordered text-center col-md-12">
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
                @foreach ($pedidosApagados as $pedido)
                <tr>
                     <th scope="row">{{$pedido->id}}</th>
                        <td>{{$pedido->numero}}</td>
                        <td>{{ \Carbon\Carbon::parse($pedido->data)->format('d/m/Y') }}</td>
                        <td>{{"R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}</td>
                        <td>{{ ($pedido->desconto). "%" }}</td>
                        <td><!--BOTOES -->
                          <div class="flex row justify-content-around">
                            {{-- Restaurar pedido apagado --}}
                              {!! Form::open(['method' => 'DELETE','route' => ['delete.pedido', $pedido->id] ]) !!}
                              <button type="submit" class="btn btn-sm btn-success" name="restaurar">Restaurar</button>
                              {!! Form::close() !!}
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
                                <table class="table table-responsive table-sm table-borderless">
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
  </div>
</div>
  @endsection
  @section('script')
  

  <script>
    $("#excluirSelecionados").on("click", function(e){
        var selecionados = [];

        $(document).find("input[name='selecionado']").each( function(){
            if( $(this).is(":checked") == true ){
              var id = $(this).val();
              selecionados.push(id);
            }
        });
          if( confirm("Excluir todos selecionados?") ){
              deletarSelecionados(selecionados);
          }
    });

    function deletarSelecionados(selecionados){
       var strIds = selecionados.join(",");
        $.ajax({
          url: "/cliente/pedido",
          type: 'DELETE',
          data: 'pedido_id='+strIds,
          '_token': $('input[name=_token]').val(),
          success: function (data) {
              if (data['status']==true) {
                  $(document).find("input[name='selecionado']").each( function(){
                    if( $(this).is(":checked") == true ){
                        var avo = $(this).parent().parent();
                        avo.fadeOut("slow");
                    }
                    alert(data['message']);
                  });
              }else{
                  alert("Um erro ocorreu");
              }
            
          }, error: function (data) {
              alert(data.responseText);
          }
        });
    }



    $("[name='delete']").on("click", function(e){
        if(!confirm("Excluir pedido?")){
            e.preventDefault();
        }
    })

    $("[name='restaurar']").on("click", function(e){
        if(!confirm("Restaurar pedido?")){
            e.preventDefault();
        }
    })

    $("#selecionaTodos").on("click", function(){
        $("[name='selecionado']").prop('checked', this.checked);//Marca os outros
        var botao = $("#excluirSelecionados");

        if(this.checked)
            botao.removeAttr('disabled');
        else
            botao.prop("disabled","disabled");
        
        
    })

    //habilitar desabilitar botao excluir
      $("[name='selecionado']").on("click", function(){
        var checado = false;

        $(document).find("input[name='selecionado']").each( function(){
            if( $(this).is(":checked") == true ){
                checado = true;
            }
        });
        var botao = $("#excluirSelecionados");

        if(!checado){
            botao.prop("disabled","disabled");
        }else{
            if(botao.is(":disabled")){
              botao.removeAttr('disabled');
          }
        }
      })



    

  </script>

@endsection

