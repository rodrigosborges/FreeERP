@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Relatório de Movimentação')
@section('body')

<table class="table">
    <form action="POST" action="" id="form">
        @csrf
        <div class="row">
            <div class="form-group col-8">
                <label for="nome">Nome do Produto</label>
                <input type="text" name="nome" id="search-input" maxlength="45" class="form-control" placeholder="Insira o nome do produto">
            </div>

            
        
        </div>

        <div class="row">
            <div class="form-group col-4">
                <label for="categoria">Categoria</label>
                <select required class="form-control" name="categoria" id="">
                <option value="-1" selected>Todas as Categorias</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
                </select>
                

            </div>
            
            <div class="form-group col-4">
                <label for="dataInicial">Data Inicial</label>
                <input type="date" name="dataInicial" class="form-control" required>            
            </div>
            
            <div class="form-group col-4">
                <label for="dataFinal">Data Final</label>
                <input type="date" name="dataFinal" class="form-control" required>            
            </div>
        
        </div>

        <div class="row">
            <div class="form-group col-12">
                <button type="submit" name="btn" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
            </div>    
        </div>
        
        <thead class="">
       
        <tr>
            <td scope="col">ID</td>
            <td scope="col">Nome</td>
            <td scope="col">Data</td>
            <td scope="col">Entrada</td>
            <td scope="col">Saída</td>
        
        </tr>
        </thead>
    </form>


    <tbody>
    </tbody>

    <tfoot>
    </tfoot>

</table>

    

<div class="row mt-5 mb-5">
        <div class="col-6">
            <canvas id="myChart"></canvas>
        </div>
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
            label: 'Movimentação',
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