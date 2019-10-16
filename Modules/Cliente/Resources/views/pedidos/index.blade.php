@extends('cliente::template')
@section('title')
Cadastro de Compras - {{ $cliente->nome }}
@endsection
@section('content')
<div class="card">
  <div id="opcoes" class="card-header flex">
    <div class="row col-12">
      <h3>Lista de Pedidos - {{ $cliente->nome }}</h3>
    </div>
    <input type="hidden" id="cliente_id" value="{{$cliente->id}}">
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
      {{-- Botao nova compra e pdf --}}
      <div class="align-self-end text-right">
        <a class="btn btn-secondary" title="{{$cliente->id}}" href="" id="btn_rel">Gerar PDF</a>
        <a class="btn btn-primary" href="{{url('/cliente/'.$cliente->id.'/pedido/novo')}}"
          style="color: white;">Adicionar
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

      </div>
      <!--Final tabela e div -->
      {{-- Inicio da tab Inativos --}}
      <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="profile-tab">
        <div class="d-flex col-12 pb-1 justify-content-end">
          <button class="btn btn-success" id="recSelecionados" disabled="">
            Recuperar selecionados
          </button>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        tabela('ativos');
        tabela('inativos');

        $(document).on('click','.page-link', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var status = $(this).closest('.tab-pane').attr('id')
            tabela(status, page)
        })
    })
    function tabela(status, page=null){
        setLoading($('#'+status))
        var id = $('#cliente_id').val();
        $.get(main_url+'/cliente/'+id+'/pedido/table/'+status+'?page='+page, function(table){
            $('#'+status).html(table);
        })
    }
    
    
</script>

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
      url: main_url + "/cliente/pedido/",
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

  $("#btn_rel").on("click", function () {
    let cliente_id = $(this).attr("title");
    let url = main_url+"/cliente/" + cliente_id + "/pedidos/pdf/";

    let dt_inicio = $("#dtInicio").val();
    if (dt_inicio != '') {
      dt_inicio = dt_inicio.split("-");
      dt_inicio = new Date(dt_inicio[0], dt_inicio[1] - 1, dt_inicio[2]);
    } else {
      dt_inicio = new Date("01/01/2000");
    }

    let dt_fim = $("#dtFim").val();
    if (dt_fim != '') {
      dt_fim = dt_fim.split("-");
      dt_fim = new Date(dt_fim[0], dt_fim[1] - 1, dt_fim[2]);
    } else {
      dt_fim = new Date("01/01/2100");
    }

    url += dataFormatada(dt_inicio) + "/" + dataFormatada(dt_fim);
    $(this).attr("href", url);
  });

  function dataFormatada(data) {
    let dia = data.getDate().toString(),
      diaF = (dia.length == 1) ? '0' + dia : dia,
      mes = (data.getMonth() + 1).toString(),
      mesF = (mes.length == 1) ? '0' + mes : mes,
      anoF = data.getFullYear();

    return diaF + "-" + mesF + "-" + anoF;
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