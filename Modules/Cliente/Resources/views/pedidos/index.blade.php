@extends('cliente::template')
@section('title')
Cadastro de Compras - {{ $cliente->nome }}
@endsection
@section('content')
<div class="card">
  <div id="opcoes" class="card-header flex">
    <div class="row col-12">
      <h3>Compras cliente {{ $cliente->nome }}</h3>
    </div>

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
        <div class="col-4 align-self-end">
          <div class="row justify-content-around ">
            {{-- Botão buscar --}}
            <button class="btn btn-outline-info d-flex" id="filtraData" type="button">
              <i class="material-icons">
                search
              </i> Buscar
            </button>
            {{-- Botão Resetar --}}
            <button class="btn btn-outline-dark d-flex" id="filtroReset" type="reset">
              <i class="material-icons">
                undo
              </i>Resetar
            </button>
          </div>
        </div>
      </form>
      {{-- Botao nova compra --}}
      <div class="align-self-end text-right">
        <a class="btn btn-primary" href="/cliente/{{$cliente->id}}/pedido/novo" style="color: white;">Adicionar
          Compra</a>
      </div>

    </div>

  </div>
  {{-- Inicio das Tabs --}}
  <ul class="nav nav-tabs justify-content-center" id="tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" href="#ativos" data-toggle="tab" id="ativos-tab" data-toggle="tab" role="tab"
        aria-controls="home" aria-selected="true">Ativos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#inativos" id="profile-tab" data-toggle="tab" href="#perfil" role="tab"
        aria-controls="profile" aria-selected="false">Inativos</a>
    </li>
  </ul>

  <div class="card-body pt-1">
    <div class="tab-content" id="tabContent">
      {{-- Inicio da tab Ativos --}}
      <div id="ativos" class="tab-pane fade show active" role="tabpanel" aria-labelledby="ativos-tab">
        <div class="d-flex col-12 pb-1 justify-content-end">
          <button class="btn btn-danger" id="excluirSelecionados" disabled="">
            Excluir selecionados
          </button>
        </div>
        <table class="table bordered text-center col-md-12" id="tablePedidos">
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
                      <li class="list-group-item active">
                        <div class="row">
                          <div class="col">Nome</div>
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
              <th scope="row">{{$pedido->id}}</th>
              <td>{{$pedido->numero}}</td>
              <td name="dtPedido">{{ $pedido->data }}</td>
              <td>{{ "R$ ".number_format($pedido->vl_itens_desconto(), 2, ',', '.') }}</td>
              <td>{{ "R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}</td>
              <td>{{ ($pedido->desconto). "%" }}</td>
              <td>
                <div class="flex row justify-content-around">
                  {{-- Editar pedido --}}
                  <a href="{{url("/cliente/pedido/".$pedido->id )}}" class="btn btn-sm btn-warning"
                    name="edit">Editar</button>
                  </a>
                  {{-- BOTAO PARA EXCLUSAO DO ITEM INDIVIDUALMENTE --}}
                  {!! Form::open(['method' => 'DELETE','route' => ['delete.pedido', $pedido->id] ]) !!}
                  <button type="submit" class="btn btn-sm btn-danger" name="delete">Excluir</button>
                  {!! Form::close() !!}
                </div>
              </td>

              <td>
                <button class="btn btn-sm btn-light" id="ocultar" type="button" data-toggle="modal"
                  data-target="#modal{{$pedido->id}}" aria-expanded="false" aria-controls="collapse{{$pedido->id}}">
                  <i class="material-icons">
                    arrow_drop_down
                  </i>
                </button>
              </td>

              <td> {{-- checkbox individual --}}
                <input type="checkbox" name="selecionado" value="{{$pedido->id}}">
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
        </table>
      </div>
      <!--Final tabela e div -->
      {{-- Inicio da tab Inativos --}}
      <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="profile-tab">
        <div class="d-flex col-12 pb-1 justify-content-end">
          <button class="btn btn-success" id="recSelecionados" disabled="">
            Recuperar selecionados
          </button>
        </div>
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
              <th>
                {{-- CheckBox  selecionar todos inativos --}}
                <input type="checkbox" id="todosInativos" />
              </th>
            </tr>
          </thead>
          <tbody>
            {{-- Preenche apagados --}}
            @foreach ($pedidosApagados as $pedido)
            <tr>
              <th scope="row">{{$pedido->id}}</th>
              <td>{{$pedido->numero}}</td>
              <td name="dtPedido">{{ $pedido->data }}</td>
              <td>{{"R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}</td>
              <td>{{ ($pedido->desconto). "%" }}</td>
              <td>
                <!--BOTOES -->
                <div class="flex row justify-content-around">
                  {{-- Restaurar pedido apagado --}}
                  {!! Form::open(['method' => 'DELETE','route' => ['delete.pedido', $pedido->id] ]) !!}
                  <button type="submit" class="btn btn-sm btn-success" name="restaurar">Restaurar</button>
                  {!! Form::close() !!}
                </div>
              </td>

              <td>
                {{-- Exibir mais --}}
                <button id="ocultar" type="button" data-toggle="collapse" data-target="#collapse{{$pedido->id}}"
                  aria-expanded="false" aria-controls="collapse{{$pedido->id}}">
                  <i class="material-icons">
                    arrow_drop_down
                  </i>
                </button>
              </td>
              <td>
                {{-- CheckBox individual --}}
                <input type="checkbox" name="selRec" value="{{$pedido->id}}">
              </td>
            </tr>
            <tr>
              <td colspan="100%" style="height: 0px; padding: 0px; margin:0px;">
                <div class="collapse" id="collapse{{$pedido->id}}">
                  <div class="row d-flex justify-content-between">

                    @forelse ($pedido->vl_total_itens() as $item)
                    <div class="col-6 pt-1">
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
                          <td>{{ "R$ ".number_format($item->preco, 2, ',', '.') }}</td>
                          <td>{{ $item->desconto." %"}}</td>
                          <td>{{ "R$ ".number_format($item->valor_total, 2, ',', '.')}}</td>
                        </tbody>
                      </table>

                    </div>
                    @empty
                    <div class="col-6 pt-1">
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
  // Acao botao excluir todos
  $("#excluirSelecionados").on("click", function () {
    let selecionados = [];

    $(document).find("input[name='selecionado']").each(function () {
      if ($(this).is(":checked") == true) {
        let id = $(this).val();
        selecionados.push(parseInt(id));
      }
    });
    if (confirm("Excluir todos selecionados?")) {
      deletarSelecionados(selecionados, "delete");
    }
  });
  //Acao restaurar
  $("#recSelecionados").on("click", function () {
    let selecionados = [];

    $(document).find("input[name='selRec']").each(function () {
      if ($(this).is(":checked") == true) {
        let id = $(this).val();
        selecionados.push(parseInt(id));
      }
    });
    if (confirm("Restaurar todos selecionados?")) {
      deletarSelecionados(selecionados, "restore");
    }
  });

  // AJAX APAGAR/RECUPERAR TODOS
  function deletarSelecionados(selecionados, tipo) {
    console.log(selecionados);
    $.ajax({
      url: "/cliente/pedido/",
      type: 'POST',

      data: { ids: selecionados, _method: "delete", '_token': $('input[name=_token]').val(), tipo: tipo }
      ,
      success: function (data) {
        if (data['status'] == true) {
          $(document).find("input[name='selecionado']").each(function () {

            if ($(this).is(":checked") == true) {
              let avo = $(this).parent().parent();
              avo.fadeOut("slow");
            }

            window.location.reload();
          });
          alert(data['message']);
          window.location.reload();
        } else {
          alert("Ocorreu um erro ao efetuar a operacao");
        }
      }, error: function (data) {
        alert(data.responseText);
      }
    });
  }

  // Filtro de data na tabela
  $("#filtraData").on("click", function () {
    let dt_inicio = $("#dtInicio").val();
    if (dt_inicio != '') {
      dt_inicio = dt_inicio.split("-");
      dt_inicio = new Date(dt_inicio[0], dt_inicio[1] - 1, dt_inicio[2]);
    };

    let dt_fim = $("#dtFim").val();
    if (dt_fim != '') {
      dt_fim = dt_fim.split("-");
      dt_fim = new Date(dt_fim[0], dt_fim[1] - 1, dt_fim[2]);
    };
    // Dois campos preenchidos, filtra por range
    if (dt_inicio != "" && dt_fim != "") {
      $(document).find("[name='dtPedido']").each(function () {
        let parts = $(this).text().split('/');
        let date = new Date(parts[2], parts[1] - 1, parts[0]);

        if (dt_inicio <= date && dt_fim >= date)
          $(this).parent().fadeIn();
        else
          $(this).parent().fadeOut("slow");

      });
      // Somente data inicio
    } else if (dt_inicio != "") {
      $(document).find("[name='dtPedido']").each(function () {
        let parts = $(this).text().split('/');
        let date = new Date(parts[2], parts[1] - 1, parts[0]);

        if (date >= dt_inicio)
          $(this).parent().fadeIn();
        else
          $(this).parent().fadeOut("slow");

      });
      // Somente data fim
    } else if (dt_fim != "") {
      $(document).find("[name='dtPedido']").each(function () {
        let parts = $(this).text().split('/');
        let date = new Date(parts[2], parts[1] - 1, parts[0]);

        if (date <= dt_fim)
          $(this).parent().fadeIn();
        else
          $(this).parent().fadeOut("slow");

      });
    } else {
      // Sem nenhum campo
      reseta_busca();
    };
  });
  // Resetar o filtro de busca
  function reseta_busca() {
    $(document).find("[name='dtPedido']").each(function () {
      $("#dtInicial").val("");
      $(this).parent().fadeIn("slow");
    })
  }
  //Acao botao reseta busca
  $("#filtroReset").on("click", function () {
    reseta_busca();
  });

  //confirmação exclusao individual
  $("[name='delete']").on("click", function (e) {
    if (!confirm("Excluir pedido?")) {
      e.preventDefault();
    }
  })
  //Confirmação restauracao
  $("[name='restaurar']").on("click", function (e) {
    if (!confirm("Restaurar pedido?")) {
      e.preventDefault();
    }
  })
  // Habilita botao excluir todos pelo checkBox seleciona todos
  $("#selecionaTodos").on("click", function () {
    $("[name='selecionado']").prop('checked', this.checked);//Marca os outros
    let botao = $("#excluirSelecionados");

    if (this.checked)
      botao.removeAttr('disabled');
    else
      botao.prop("disabled", "disabled");
  })
  // habilita botao Recuperar checkbox todos
  $("#todosInativos").on("click", function () {
    $("[name='selRec']").prop('checked', this.checked);//Marca os outros
    let botao = $("#recSelecionados");

    if (this.checked)
      botao.removeAttr('disabled');
    else
      botao.prop("disabled", "disabled");
  })
  //habilitar desabilitar botao excluir pelos checkbox individuais
  $("[name='selRec']").on("click", function () {
    let checado = false;

    $(document).find("input[name='selRec']").each(function () {
      if ($(this).is(":checked") == true) {
        checado = true;
      }
    });
    let botao = $("#recSelecionados");

    if (!checado) {
      botao.prop("disabled", "disabled");
    } else {
      if (botao.is(":disabled")) {
        botao.removeAttr('disabled');
      }
    }
  })
  //habilitar desabilitar botao excluir pelos checkbox individuais
  $("[name='selecionado']").on("click", function () {
    let checado = false;

    $(document).find("input[name='selecionado']").each(function () {
      if ($(this).is(":checked") == true) {
        checado = true;
      }
    });
    let botao = $("#excluirSelecionados");

    if (!checado) {
      botao.prop("disabled", "disabled");
    } else {
      if (botao.is(":disabled")) {
        botao.removeAttr('disabled');
      }
    }
  })





</script>

@endsection