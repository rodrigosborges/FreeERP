@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Relatório de Custos')
@section('body')

<table class="table">
                <form method="POST" action="{{url('/estoque/relatorio/custos')}}" id="form">
                    @csrf

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nome">Produto</label>
                            <select required class="form-control" name="estoque_id">
                                <option value="-1" selected>Todo o Estoque</option>
                                @foreach($estoques as $e)
                                    <option value="{{$e->id}}">{{$e->produtos->last()->nome}} - {{$e->tipoUnidade->nome}}({{$e->tipoUnidade->quantidade_itens}} itens)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="dataInicial">Data Inicial</label>
                            <input type="date" name="data_inicial" class="form-control" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="dataFinal">Data Final</label>
                            <input type="date" name="data_final" class="form-control" required>
                        </div>
                    </div>
                    <div class="row float-right">
                        <div class="form-group col-12">
                            <button name="btn" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                        </div>
                    </div>
                        
                    </div>
                </form>
    <div class="card col-12">
        <div class="card-header">Relatório</div>
            <div class="row">
                <div class="col-6" style="">
                    
                </div>
                <div class="col-6">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
<script>

window.onload = function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var teste = <?php echo $labels; ?>;
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: teste,
            datasets: [{
                label: 'Custo',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php echo $dados; ?>
            }]
        },

        // Configuration options go here
        options: {}
    });
}
</script>

@endsection