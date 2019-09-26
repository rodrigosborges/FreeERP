@extends('estoque::estoque.estoqueTemplate')
@section('title','Saída de Produtos')
@section('body')
<form method="POST" action="" id="form">
                    @csrf

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="nome">Nome do Produto</label>
                            <input id="search-input" placeholder="Insira o nome do produto" maxlength="45" class="form-control" type="text" name="nome">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="categoria">Categoria</label>
                            <select  class="form-control" name="categoria">
                                <option value="-1" selected>Todas Categorias</option>
                               
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="dataInicial">Data Inicial</label>
                            <input type="date" name="dataInicial" class="form-control" >
                        </div>
                        <div class="form-group col-3">
                            <label for="dataFinal">Data Final</label>
                            <input type="date" name="dataFinal" class="form-control" >
                        </div>
                    </div>
                    <div class="row float-right">
                        <div class="form-group col-12">
                            <button type="submit" name="btn" class="btn btn-sm btn-secondary btn-search" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                        </div>
                    </div>
                        
                    
                </form>
<canvas id="myChart" class="chart_custo" width="300"></canvas>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>

@endsection
@yield('js')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
  $('.chart_custo').hide();  
  $('.btn-search').click(function(e){
      $('.chart_custo').show('slow')
      e.preventDefault();
  })
})
</script>


