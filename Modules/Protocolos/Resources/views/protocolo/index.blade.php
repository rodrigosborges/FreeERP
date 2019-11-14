@extends('protocolos::template')

@section('title','Lista de Protocolos')
@section('relatorio')
<div class="container">
        <div class="card-deck justify-content-between">
            <div class="card bg-light mb-3" style="max-width: 260px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <canvas id="protocolosEncalhados" width="50" height="50"></canvas>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h6 class="text-center">ENCALHADOS</h6>
                            <h6 class="text-center">{{$data['encalhado']}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-light mb-3" style="max-width: 260px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <canvas id="protocolosAndamento" width="50" height="50"></canvas>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h6 class="text-center">EM ANDAMENTO</h6>
                            <h6 class="text-center">{{$data['andamento']}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-light mb-3" style="max-width: 260px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <canvas id="protocolosFinalizados" width="50" height="50"></canvas>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h6 class="text-center">FINALIZADOS</h6>
                            <h6 class="text-center">{{$data['finalizado']}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('body')
    <div class="row">
        <div class="col-md-8">
            <form id="form">
                <div class="form-group">
                    <div class="input-group">
                        <input id="search-input" class="form-control" type="text" name="pesquisa" />
                        <i id="search-button" class="btn btn-info material-icons ml-2">search</i>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="text-right">
                <a class="btn btn-success" href="{{ url('protocolos/protocolos/create') }}">
                    <i class="material-icons add_circle_outline" style="vertical-align:middle; font-size:25px; margin-right:5px;">add_circle_outline</i>Novo Protocolo
                </a>
            </div>
        </div>
    </div>
    
    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="caixa-entrada-tab" data-toggle="tab" href="#caixa-entrada" role="tab" aria-controls="caixa-entrada" aria-selected="true">Caixa de entrada</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="despacho-tab" data-toggle="tab" href="#despacho" role="tab" aria-controls="despacho" aria-selected="true">Aguardando despacho</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="caixa-saida-tab" data-toggle="tab" href="#caixa-saida" role="tab" aria-controls="caixa-saida" aria-selected="true">Caixa de saída</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inativos-tab" data-toggle="tab" href="#inativos" role="tab" aria-controls="inativos" aria-selected="false">Inativos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="caixa-entrada" role="tabpanel"></div>
        <div class="tab-pane fade" id="despacho" role="tabpanel"></div>
        <div class="tab-pane fade" id="caixa-saida" role="tabpanel"></div>
        <div class="tab-pane fade" id="inativos" role="tabpanel"></div>
    </div>
    
@endsection

@section('script')
    <script>
    function setLoading(target) {
    var loading = $('<h3></h3>').attr({'class': 'text-center'})
    var img = $('<img />').attr({'src': main_url+"/modules/protocolos/img/load.svg"})
    img.appendTo(loading)
    target.html(loading)
    }

     search = (url, target) => {
        setLoading(target)
        $.ajax({
            type: "GET",
            url: url,
            data: $("#form").serialize(),
            success: function (data) {
                target.html(data)
            },
            error: function (jqXHR, exception) {
                $("#results").html("<div class='alert alert-danger'>Desculpe, ocorreu um erro. <br> Recarregue a página e tente novamente</div>")
            },
        })
    }
    ativosInativos = (url) => {
        search(`${url}/caixa-entrada`, $("#caixa-entrada"))
        search(`${url}/despacho`, $("#despacho"))
        search(`${url}/inativos`, $("#inativos"))
        search(`${url}/caixa-saida`, $("#caixa-saida"))
        $("#caixa-entrada").on('click', 'ul.pagination a', function(e){
            e.preventDefault()
            search($(this).attr('href'), $("#caixa-entrada"))
        })
        $("#despacho").on('click', 'ul.pagination a', function(e){
            e.preventDefault()
            search($(this).attr('href'), $("#despacho"))
        })
        $("#caixa-saida").on('click', 'ul.pagination a', function(e){
            e.preventDefault()
            search($(this).attr('href'), $("#caixa-saida"))
        })
        $("#inativos").on('click', 'ul.pagination a', function(e){
            e.preventDefault()
            search($(this).attr('href'), $("#inativos"))
        })
        
    }
    $(document).on("click", "#search-button", function() {
        ativosInativos(`${main_url}/protocolos/protocolos/list`)
    })
    $(document).ready(function(){
        ativosInativos(`${main_url}/protocolos/protocolos/list`)
        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                e.preventDefault()
                ativosInativos(`${main_url}/protocolos/protocolos/list`)
            }
        });
    });

    var ctx = document.getElementById('protocolosEncalhados');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{$data['encalhado']}},{{$data['total'] - $data['encalhado']}}],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(211, 211, 211)'
                ],
                borderColor: [
                    'rgb(255, 99, 132, 1)',
                    'rgb(211, 211, 211)'
                ],
                borderWidth: 1
            }],

        },
        
    });

    var ctx = document.getElementById('protocolosAndamento');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'Andamento',
                data: [{{$data['andamento']}},{{$data['total'] - $data['andamento']}}],
                backgroundColor: [
                    'rgb(255,193,7)',
                    'rgb(211, 211, 211)'
                ],
                borderColor: [
                    'rgb(255,193,7)',
                    'rgb(211, 211, 211)'
                ],
                borderWidth: 1
            }]
        },
    });

    var ctx = document.getElementById('protocolosFinalizados');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'Finalizado',
                data: [{{$data['finalizado']}},{{$data['total'] - $data['finalizado']}}],
                backgroundColor: [
                    'rgb(40,167,69)',
                    'rgb(211, 211, 211)'
                ],
                borderColor: [
                    'rgb(40,167,69)',
                    'rgb(211, 211, 211)'
                ],
                borderWidth: 1
            }]
        },
    });
    </script>
@endsection
