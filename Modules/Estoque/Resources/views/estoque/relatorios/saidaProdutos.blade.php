@extends('estoque::estoque.estoqueTemplate')
@section('title','Saída de Produtos')
@section('body')
<form method="POST" action="" id="form">
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <label for="nome">Estoque</label>
            <select name="estoque" id="" class="custom-select estoque">
                <option value="0">Itens de Estoque</option>
                @foreach($data['estoque'] as $estoque)
                <option value="{{$estoque->id}}">{{$estoque->produtos->last()->nome . '-' . $estoque->tipoUnidade->nome}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-4 com-md-6 col-sm-12">
            <label for="categoria">Categoria</label>
            <select class="custom-select categoria" name="categoria">
                <option value="0" selected>Todas Categorias</option>
                @foreach($data['categorias'] as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group col-lg-3 col-md-6 col-sm-12">
            <label for="dataInicial">Data Inicial</label>
            <input type="date" name="dataInicial" class="form-control dataInicial">
        </div>
        <div class="form-group col-lg-3 col-md-6 col-sm-12">
            <label for="dataFinal">Data Final</label>
            <input type="date" name="dataFinal" class="form-control dataFinal ">
        </div>

        <div class="form-group col-lg-2 col-md col-sm-12">
            <button type="submit" name="btn" class="btn btn-sm btn-secondary btn-search" style="font-size:18px; margin-top:30px"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
        </div>
    </div>
</form>
<div class="row">
    <div class=" col-md-6 col-sm-12">
        <div class="card" style="min-width:250px;">
            <div class="card-header">Relatório:</div>
            <div class="card-body">
                Item Selecionado
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text material-icons">store</div>
                    </div>
                    <input type="text" disabled class="form-control" id="produtoBusca" name="produto">
                </div>
                Período inícial
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text material-icons">date_range</div>
                    </div>
                    <input type="text" id="periodoInicialBusca" disabled class="form-control " value="">
                </div>
                Período final
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text material-icons">date_range</div>
                    </div>
                    <input type="text" id="periodoFinalBusca" disabled class="form-control " value="">
                </div>
                Preço de custo médio
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text material-icons">attach_money</div>
                    </div>
                    <input type="text" disabled class="form-control"  id="precoCustoBusca" name="produto">
                </div>
            </div>
        </div>
    </div>
    <div class=" col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">Header</div>
            <div class="card-body">
                <canvas id="chart1" class="chart_custo" width="300"></canvas>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">Relatório detalhado</div>
            <div class="card-body">
                <div class="form-row">
                    <!--L 1-->
                    <div class="form-group col-lg-4 col-md-12 col-sm-12">
                        <label for="qtd_movimentada">Quantidade Total Movimentada </label>
                        <input type="text" id='qtd_movimentada' class="form-control" disabled>
                    </div>
                    <div class="form-group col-lg-4 col-md-12 col-sm-12">
                        <label for="custo_periodo">Costo no Periíodo </label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-lg-4 col-md-12 col-sm-12">
                        <label for="">Quantidade Movimentada </label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <!--L 2-->
                    <div class="form-group col-lg-4 col-md-12 col-sm-12">
                        <label for="qtd_movimentada">Dia com maior custo </label>
                        <input type="text" class="form-control" disabled>
                    </div>

                    <div class="form-group col-md-4 col-sm-12">
                        <label>Dia com menor custo</label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="">Maior Preço unitário </label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <!--L3-->
                    <div class="form-group col-md-4 col-sm-12">
                        <label>Menor preço unitário </label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label>Dia com maior movimentação </label>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="">Dia com menor movimentação</label>
                        <input type="text" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">Header</div>
            <div class="card-body">
                <table class="table table-responsive text-center table-striped" style="">
                    <caption>List of users</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço unitario</th>
                            <th scope="col">Custo Total</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td>1</td>
                            <td>22/11/2018</td>
                            <td>50</td>
                            <td>6000</td>
                            <td>300000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-6 col-sm-12">
        <canvas id="chart2" class="chart_custo" width="300"></canvas>
    </div>
</div>


@endsection
@yield('js')


<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        mostraGrafico1();
        mostraGrafico2();
        //   $('.chart_custo').hide();
        $('.btn-search').click(function(e) {
            e.preventDefault()
            var dataInicial = $('.dataInicial').val()
            var dataFinal = $('.dataFinal').val()
            var categoria = $('.categoria').val()
            var estoque = $('.estoque').val()
            $.ajax({
                url: 'saida',
                type: 'POST',
                data: {
                    inicio: dataInicial,
                    fim: dataFinal,
                    categoria: categoria,
                    estoque: estoque,
                    '_token': $('input[name=_token]').val(),

                }
            }).done(function(data) {
                data = $.parseJSON(data);
                console.log ("data",data);
                var qtdTotalMovimentada = 0;
                var precoCustoMedio = 0;
                $.each(data['estoque'], function(chave, valor) {
                    //  console.log(valor[chave]);
                    qtdTotalMovimentada += valor['quantidade']
                    console.log( "quantidade",valor['quantidade']) 
                })
                $.each(data['movimentacao'], function(chave, valor) {
                    //  console.log(valor[chave]);
                    precoCustoMedio += (valor['quantidade'] * valor['preco_custo']) / data['movimentacao'].length;
                })
              //  console.log(qtdTotalMovimentada)
                if (dataInicial != "" && dataInicial != null) {
                    $('#periodoInicialBusca').val(dataInicial);
                }else
                $('#periodoInicialBusca').val("");
                if (dataFinal != "" && dataFinal != null) 
                    $('#periodoFinalBusca').val(dataFinal);
                else{
                    $('#periodoFinalBusca').val("");
                }
                $('#qtd_movimentada').val(qtdTotalMovimentada)
                $('#precoCustoBusca').val(precoCustoMedio)
                var item = $('.estoque option:selected').text()
                item = item.split('-')[0]

               console.log(item);
               if( $('.estoque option:selected').val()!=0)
                $('#produtoBusca').val(item)
                else{
                    $('#produtoBusca').val('Todos itens ');
                }
            }).fail(function() {
                console.log("fail")
            })
           
            //   e.preventDefault();
        })
        

        function mostraGrafico1() {
            var ctx = document.getElementById('chart1').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Custo',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [0, 10, 5, 2, 20, 30, 45]
                    }]
                },

                // Configuration options go here
                options: {}
            })

        }

        function mostraGrafico2() {
            var ctx = document.getElementById('chart2').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: ['Estoque 1', 'Estoque 2', 'Estoque 3', 'Estoque 4'],
                    datasets: [{
                        label: 'Total de saída',
                        backgroundColor: ["rgba(29, 0, 207, 0.7)", "rgba(255,0,0,0.7)", "rgba(257,33,100,0.7)", "rgba(10,255,128,0.7)"],
                        borderColor: ['rgb(255, 99, 132, 1)', 'rgba(0,200,129,1)', 'rgba(69,69,69,1)', 'rgba(200,100,0,0.7)'],
                        data: [3, 10, 5, 2]
                    }]
                },

                // Configuration options go here
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: "Total por item de estoque"
                    },
                    legend: {
                        display: false
                    }
                }
            })
        }
    })
</script>
