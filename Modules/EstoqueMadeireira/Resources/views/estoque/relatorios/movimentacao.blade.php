@extends('estoquemadeireira::estoque.template')
@section('title', 'Relatório de Movimentação')
@section('body')


<div class="container">
    <form method="POST" action="{{url('/estoquemadeireira/relatorio/movimentacao')}}" id="form">
        @csrf
        <div class="row">
            <div class="form-group col-lg-4 col-sm-12">
                <label for="estoque_id">Produto</label>
                <select required class="form-control" name="estoque_id" >
                    <option value="-1">Todo o Estoque</option>
                    @foreach($data['estoque'] as $e)
                        <option value="{{$e->id}}">{{$e->produtos->last()->nome}} - {{$e->tipoUnidade->nome}}({{$e->tipoUnidade->quantidade_itens}} itens)}}</option>
                    @endforeach
                </select>       
            </div>
            <div class="form-group col-lg-3">
                <label for="dataInicial">Data Inicial</label>
                <input type="date" name="dataInicial" class="form-control" required>
            </div>
            <div class="form-group col-lg-3">
                <label for="dataFinal">Data Final</label>
                <input type="date" name="dataFinal" class="form-control" required>
            </div>
            <div class="form-group col-lg-2">
                <button name="btn" class="btn btn-md btn-secondary align-bottom" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>               
            </div>
        </div>
    </form>
</div>
@if($data['flag'] == 1)
    <div class="container">
        <div class="row">
            <div class="form-group col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Relatório 
                    </div>  
                    <div class="card-body">
                    Estoque Selecionado
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">store</div>
                        </div>
                         <input type="text" disabled class="form-control" name="produto" value="{{isset($data['estoqueSelecionado']) ?  $data['estoqueSelecionado'] : ''}}">               
                    </div>
                    Data Inicial
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">date_range</div>
                        </div>
                        <input type="text" disabled class="form-control" value="{{isset($data['dataInicial']) ? $data['dataInicial'] : ''}}" >
                    </div>                                                                         
                    Data Final 
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">date_range</div>
                        </div>
                        <input type="text" disabled class="form-control" value="{{isset($data['dataFinal']) ? $data['dataFinal'] : ' '}}" >
                    </div>
                    Total de entradas
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">arrow_upward</div>
                        </div>
                        <input type="text" disabled class="form-control" name="entrada" value="{{isset($data['totalEntrada']) ? $data['totalEntrada'] : ''}}">
                    </div>
                    Total de Saídas
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">arrow_downward</div>
                        </div>
                        <input type="text" disabled class="form-control" name="saida" value="{{isset($data['totalSaida']) ? $data['totalSaida'] : ''}}">  
                    </div>
                    Dia com maior Movimentação
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">trending_up</div>
                        </div>
                        <input type="text" disabled class="form-control" name="saida" value="{{isset($data['maiorMovimentacao']) ? $data['maiorMovimentacao'] : ' '}}">  
                    </div>
                    Dia com menor Movimentação
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">trending_down</div>
                        </div>
                        <input type="text" disabled class="form-control" name="saida" value="{{isset($data['menorMovimentacao']) ? $data['menorMovimentacao'] : ' '}}">  
                    </div>

                    

                    </div>
                
              
                </div>
                
            
            </div>
            <div class="card col-8">
                <div class="card-header">Movimentações</div>
                <canvas id="myChart"></canvas>
                <canvas id="myChart2"></canvas>
            </div>
    
        </div>
    </div>
@endif


<script>
var ctx = document.getElementById('myChart').getContext('2d');
var ctx2 = document.getElementById('myChart2').getContext('2d');
var labels = <?php echo $data['labels']; ?>;
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
    data: {
        labels: labels,
        datasets: [{
            label: 'Movimentação: Entrada',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo $data['dadosEntrada']; ?>
        }]
    },
    // Configuration options go here
    options: {}
});
var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'bar',
    // The data for our dataset
    data: {
        labels: labels,
        datasets: [{
            label: 'Movimentação: Saída',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo $data['dadosSaida']; ?>
        }]
    },
    // Configuration options go here
    options: {}
});
</script>
@endsection