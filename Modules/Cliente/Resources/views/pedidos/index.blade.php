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
          <input type="date" id="dtInicio" name="data_inicio" class="form-control">
        </div>
        <div class="col-4">
          <label class="mr-sm-2" for="dtFim">Data Final</label>
          <input type="date" id="dtFim" name="data_fim" class="form-control">
        </div>
        <div class="col-4 align-self-end">
          <div class="row justify-content-around ">
            {{-- Botão buscar --}}
            <button class="btn btn-outline-success d-flex" id="filtraData" type="button">
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
  <ul class="nav nav-tabs nav-justified" id="tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" href="#ativos" data-toggle="tab" id="ativos-tab" data-toggle="tab" role="tab"
        aria-controls="home" aria-selected="true">Ativos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#inativos" id="profile-tab" data-toggle="tab" href="#perfil" role="tab"
        aria-controls="profile" aria-selected="false">Inativos</a>
    </li>
  </ul>

  <div class="card-body">
    <div class="tab-content" id="tabContent">
      <div id="ativos" class="tab-pane fade show active" role="tabpanel" aria-labelledby="ativos-tab">
        

      </div>
      <div class="tab-pane fade" id="inativos" role="tabpanel" aria-labelledby="profile-tab">
        

      </div>
    </div>
  </div>

</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        var id = $('#cliente_id').val();
        tabela('ativos',main_url+'/cliente/'+id+'/pedido/table/ativos');
        tabela('inativos',main_url+'/cliente/'+id+'/pedido/table/inativos');
        var data_inicio = '';
        var data_fim = '';
        $(document).on('click','.page-link', function(e){
            e.preventDefault();
            var status = $(this).closest('.tab-pane').attr('id')
            tabela(status, $(this).attr('href')+'&data_inicio='+data_inicio+'&data_fim='+data_fim)
        })

        $("#filtraData").on("click", function () {
          data_inicio = $("[name='data_inicio']").val();
          data_fim = $("[name='data_fim']").val();

          tabela('ativos',main_url+'/cliente/'+id+'/pedido/table/ativos?data_inicio='+data_inicio+'&data_fim='+data_fim);
          tabela('inativos',main_url+'/cliente/'+id+'/pedido/table/inativos?data_inicio='+data_inicio+'&data_fim='+data_fim);
        });


    })

    function tabela(status, url){
        setLoading($('#'+status))
        $.get(url, function(table){
            $('#'+status).html(table);
        })
    }
    

  

  $("#btn_rel").on("click", function () {
    let cliente_id = $(this).attr("title");
    let url = "/cliente/" + cliente_id + "/pedidos/pdf/";

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


  //Acao botao reseta busca
  $("#filtroReset").on("click", function () {
    $(document).find("[name='dtPedido']").each(function () {
      $("#dtInicial").val("");
      $(this).parent().fadeIn("slow");
    })
  });


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