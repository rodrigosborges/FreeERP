@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Relatório de Custos')
@section('body')
<div class="container">
    <form method="POST" action="{{url('/estoque/relatorio/custos')}}" id="form">
        @csrf
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label for="estoque_id">Produto</label>
                <select required class="form-control" name="estoque_id">
                    <option value="-1" selected>Todo o Estoque</option>
                    @foreach($data['estoque'] as $e)
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
        </div>
        <div class="row">
            <div class="col-lg-12 text-right col-sm-12">
                    <button name="btn" class="btn btn-sm btn-secondary align-bottom" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
            </div>
        </div>
    </form>
</div>
@if($data['flag'] == 1)
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 text-right">
            <form method="POST" action="{{url('/estoque/pdf')}}">
            @csrf
                <input type="text" name="data_inicial" hidden value="{{isset($data['data_inicial']) ? $data['data_inicial'] : ''}}">
                <input type="text" name="data_final" hidden value="{{isset($data['data_final']) ? $data['data_final'] : ''}}">
                <input type="text" name="estoque_id" hidden value="{{isset($data['estoque_id']) ? $data['estoque_id'] : ''}}">
                <button type="submit" class="btn btn-primary">Gerar PDF</button>
            </form>
        </div>
    </div>
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
                            <input type="text" disabled class="form-control text-right" value="{{isset($data['estoque_selecionado']) ? $data['estoque_selecionado'] : ''}}" name="produto">
                    </div>
                    Período inícial
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">date_range</div>
                        </div>
                            <input type="text" disabled class="form-control text-right" value="{{isset($data['data_inicial']) ? $data['data_inicial'] : ''}}">
                    </div>
                    Período final
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">date_range</div>
                        </div>
                        <input type="text" disabled class="form-control text-right" value="{{isset($data['data_inicial']) ? $data['data_final'] : ''}}">
                    </div>
                    Preço de custo médio
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text material-icons">attach_money</div>
                        </div>
                            <input type="text" disabled class="form-control text-right" name="produto" value="R${{isset($data['custo_medio']) ? $data['custo_medio'] : ''}}">
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
                            <input type="text" class="form-control text-right" name="quantidade" value="{{isset($data['quantidade_movimentada']) ?  $data['quantidade_movimentada'] : '0'}} unidades" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="diaMaiorCusto">Custo total no período</label>
                            <input type="text" class="form-control text-right" name="diaMaiorCusto" value="R${{isset($data['custo_total']) ? $data['custo_total'] : ' '}}" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Dia com maior custo</label>
                            <input type="text" class="form-control text-right" name="quantidade" value="{{isset($data['dia_maior_custo']) ? $data['dia_maior_custo'] : ''}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Dia com menor custo</label>
                            <input type="text" class="form-control text-right" name="quantidade" value="{{isset($data['dia_menor_custo']) ? $data['dia_menor_custo'] : ''}}" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Maior preço unitario</label>
                            <input type="text" class="form-control text-right" name="quantidade" value="R${{isset($data['maior_custo']) ? $data['maior_custo'] : ''}}" disabled>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="quantidade">Menor preço unitario</label>
                            <input type="text" class="form-control text-right" name="quantidade" value="R${{isset($data['menor_custo']) ? $data['menor_custo'] : ''}}" disabled>
                        </div>
                    </div>
                    
                    <table class="table text-center table-striped">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Data</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Preço unitario</th>
                                <th scope="col">Custo Total</th>
                            </tr>
                        <tbody>
                            @if(isset($data['movimentacao']))
                                @foreach($data['movimentacao'] as $m)
                                <tr>
                                    <td>{{$m->id}}</td>
                                    <td>{{$m->created_at}}</td>
                                    <td>{{$m->quantidade}}</td>
                                    <td>R${{$m->preco_custo}}</td>
                                    <td>R${{$m->preco_custo*$m->quantidade}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<script>

window.onload = function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var teste = <?php echo $data['labels']; ?>;
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
                data: <?php echo $data['dados']; ?>
            }]
        },

        // Configuration options go here
        options: {}
    });
}
</script>

@endsection