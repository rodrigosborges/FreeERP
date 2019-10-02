@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Relatório de Custos')
@section('body')
<div class="container">
    <form method="POST" action="{{url('/estoque/relatorio/custos')}}" id="form">
        @csrf
        <div class="row">
            <div class="form-group col-lg-5 col-sm-12">
                <label for="estoque_id">Produto</label>
                <select required class="form-control" name="estoque_id">
                    <option value="-1" selected>Todo o Estoque</option>
                    @foreach($estoques as $e)
                        <option value="{{$e->id}}">{{$e->produtos->last()->nome}} - {{$e->tipoUnidade->nome}}({{$e->tipoUnidade->quantidade_itens}} itens)</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-3 col-sm-12">
                <label for="dataInicial">Data Inicial</label>
                <input type="date" name="data_inicial" class="form-control" required>
            </div>
            <div class="form-group col-lg-3 col-sm-12">
                <label for="dataFinal">Data Final</label>
                <input type="date" name="data_final" class="form-control" required>
            </div>
            <div class="form-group col-lg-1 col-sm-12">
                    <button name="btn" class="btn btn-md btn-secondary align-bottom" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
            </div>
        </div>
    </form>
</div>
<div class="container">
    <div class="row d-flex justify-content-between">
        <div class="form-group col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header">Relatório</div>
                <div class="card-body">
                    Estoque selecionado
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">store</div>
                        </div>
                            <input type="text" disabled class="form-control" name="produto">
                    </div>
                    Período inícial
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">date_range</div>
                        </div>
                            <input type="text" disabled class="form-control" name="produto">
                    </div>
                    Período final
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">date_range</div>
                        </div>
                            <input type="text" disabled class="form-control" name="produto">
                    </div>
                    Preço de custo médio
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">attach_money</div>
                        </div>
                            <input type="text" disabled class="form-control" name="produto">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-header">Gráfico de Custos</div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Relatório detalhado
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Quantidade total movimentada</label>
                            <input type="text" class="form-control" name="quantidade" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="diaMaiorCusto">Custo total no período</label>
                            <input type="text" class="form-control" name="diaMaiorCusto" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="diaMenorCusto">Quantidade movimentada</label>
                            <input type="text" class="form-control" name="diaMenorCusto" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Dia com maior custo</label>
                            <input type="text" class="form-control" name="quantidade" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Dia com menor custo</label>
                            <input type="text" class="form-control" name="quantidade" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Maior preço unitario</label>
                            <input type="text" class="form-control" name="quantidade" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Menor preço unitario</label>
                            <input type="text" class="form-control" name="quantidade" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Dia com maior movimentação</label>
                            <input type="text" class="form-control" name="quantidade" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Dia com menor movimentação</label>
                            <input type="text" class="form-control" name="quantidade" disabled>
                        </div>
                    </div>
                    <table class="table text-center table-striped">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Data</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Preço unitario</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
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