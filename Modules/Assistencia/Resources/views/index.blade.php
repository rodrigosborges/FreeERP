@extends('assistencia::layouts.master')

@section('title','Assistência Técnica')

@section('css')
<style type="text/css">
.caixa {
    display: flex;
    justify-content: space-around;
}
</style>
@stop

@section('content')
<input type="hidden" name="pago" value="{{$pago}}">
<input type="hidden" name="pendente" value="{{$pendente}}">

<div class="card">

    <div class="card-header caixa">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{route('consertos.index')}}">
                    <h3>Consertos</h3>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('cliente.index')}}">
                    <h3>Clientes</h3>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <h3>Estoque</h3>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('pecas.localizar')}}">Peças</a>
                    <a class="dropdown-item" href="{{route('servicos.localizar')}}">Mão de obra</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('tecnico.index')}}">
                    <h3>Tecnicos</h3>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('pagamento.index')}}">
                    <h3>Pagamentos</h3>
                </a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-6">
            
            <div class="text-center">
                <h4>Clientes para informar</h4>
            
            
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Ordem</th>
                                <th>Cliente</th>
                                <th>Contato</th>
                            </tr>
                            @foreach($finalizados as $fin)
                                <tr>
                                    <td>{{$fin->numeroOrdem}}</td>
                                    <td>{{$fin->cliente->nome}}</td>
                                    <td>{{$fin->cliente->celnumero}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        
                        </tfoot>
                        <tfoot>
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <p class="text-center">
                                        Página {{$finalizados->currentPage()}} de {{$finalizados->lastPage()}} páginas

                                    </p>
                                </td>
                            </tr>
                            @if($finalizados->lastPage() > 1)
                            <tr>
                                <td colspan="100%">
                                    {{ $finalizados->links() }}
                                </td>
                            </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body text-center">
                    <div id="donutchart" style="width: 400px; height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>



</div>

@stop
@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load("current", {
    packages: ["corechart"]
});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var pago = parseInt($("input[name='pago']").val());
    var pendente = parseInt($("input[name='pendente']").val());

    var data = google.visualization.arrayToDataTable([
        ['Pagamentos', 'pedente ou pago'],
        ['Pendente', pendente],
        ['Pago', pago],

    ]);

    var options = {
        title: 'Pagamentos',
        pieHole: 0.4,
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
}
</script>

@stop