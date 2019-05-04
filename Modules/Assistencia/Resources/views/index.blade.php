@extends('assistencia::layouts.master')

@section('title','Assistência Técnica')

@section('css')
@stop

@section('content')
<div class="card">

  <ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
      <a class="nav-link" href="{{route('consertos.index')}}"><h3>Consertos</h3?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('cliente.index')}}"><h3>Clientes</h3?></a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><h3>Estoque</h3?></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('pecas.localizar')}}">Peças</a>
          <a class="dropdown-item" href="{{route('servicos.localizar')}}">Mão de obra</a>
        </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('pagamento.index')}}"><h3>Pagamentos</h3?></a>
    </li>
  </ul>
  <div class="row">
    <div class="col">
      <div id="curve_chart" style="width: 500px; height: 300px"></div>
    </div>
    <div class="col">
      <div id="donutchart" style="width: 500px; height: 300px;"></div>
    </div>
  </div>

</div>







@stop
@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Vendas', 'q iso'],
          ['Peças',     5],
          ['Serviços',      5],
          ['Produtos',  5],
          ['Softwares', 5]

        ]);

        var options = {
          title: 'Vendas da empresa',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Ano', 'Vendas', 'Despesas'],
      ['2004',  1000,      400],
      ['2005',  1170,      460],
      ['2006',  660,       1120],
      ['2007',  1030,      540]
    ]);

    var options = {
      title: 'Performance da empresa',
      curveType: 'function',
      legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>
@stop
