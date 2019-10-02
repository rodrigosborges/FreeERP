@extends('estoque::estoque.estoqueTemplate')
@section('title','Saída de Produtos')
@section('body')
<form method="POST" action="" id="form">
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <label for="nome">Nome do Produto</label>
          <select name="produto" id="" class="custom-select produto">
          <option value="0">Todos os Produtos</option>
          @foreach($data['produtos'] as $produto)
            <option value="{{$produto->id}}">{{$produto->nome}}</option>
          @endforeach
          </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-4 com-md-6 col-sm-12">
            <label for="categoria">Categoria</label>
            <select  class="custom-select categoria"  name="categoria">
                <option value="0" selected>Todas Categorias</option>
                @foreach($data['categorias'] as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
          @endforeach

            </select>
        </div>
        <div class="form-group col-lg-3 col-md-6 col-sm-12">
            <label for="dataInicial">Data Inicial</label>
            <input type="date" name="dataInicial" class="form-control dataIncial" >
        </div>
        <div class="form-group col-lg-3 col-md-6 col-sm-12">
            <label for="dataFinal">Data Final</label>
            <input type="date" name="dataFinal" class="form-control dataFinal " >
        </div>

        <div class="form-group col-lg-2 col-md col-sm-12">
            <button type="submit" name="btn" class="btn btn-sm btn-secondary btn-search" style="font-size:18px; margin-top:30px"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
        </div>
    </div>
</form>
<div class=" col-sm-6">
    <canvas id="myChart" class="chart_custo" width="300"></canvas>
</div>
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
      e.preventDefault()
      var dataInicial = $('.dataInicial').val()
      var dataFinal = $('.dataFinal').val()
      var categoria = $('.categoria').val()
      var produto = $('.produto').val()
      $.ajax({ 
          url: '/estoque/relatorio/saida',
          type: 'POST',
          data:{
              inicio: dataInicial,
              fim : dataFinal,
              categoria : categoria,
              produto : produto,

          }
      }).done(function(data){
        console.log(data)
      }).fail(function(){
        console.log("fail")
      })
      $('.chart_custo').show('slow')
   //   e.preventDefault();
  })
})
</script>
