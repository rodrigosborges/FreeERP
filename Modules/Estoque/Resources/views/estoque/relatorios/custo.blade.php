@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Relatório de Custos')
@section('body')

<table class="table">
                <form method="POST" action="" id="form">
                    @csrf

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nome">Produto</label>
                            <select required class="form-control" name="categoria">
                                <option value="-1" selected>Todo o Estoque</option>
                                @foreach($estoques as $e)
                                    <option value="{{$e->id}}">{{$e->produtos->last()->nome}} - {{$e->tipoUnidade->nome}}({{$e->tipoUnidade->quantidade_itens}} itens)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="dataInicial">Data Inicial</label>
                            <input type="date" name="dataInicial" class="form-control" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="dataFinal">Data Final</label>
                            <input type="date" name="dataFinal" class="form-control" required>
                        </div>
                    </div>
                    <div class="row float-right">
                        <div class="form-group col-12">
                            <button onClick="gerarGrafico();" name="btn" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                        </div>
                    </div>
                        
                    </div>
                </form>

<div class="row mt-5 mb-5">
    <div class="col-12">
        <canvas id="myChart"></canvas>
    </div>
</div>
{{$dados}}
<script>

function gerarGrafico() {
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