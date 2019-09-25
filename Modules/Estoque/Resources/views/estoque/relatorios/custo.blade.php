@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Relatório de Custos')
@section('body')

<table class="table">
                <form method="POST" action="" id="form">
                    @csrf

                    <div class="row">
                        <div class="form-group col-8">
                            <label for="nome">Nome do Produto</label>
                            <input id="search-input" placeholder="Insira o nome do produto" maxlength="45" class="form-control" type="text" name="nome">
                        </div>
                        <div class="form-group col-4">
                            <label for="categoria">Categoria</label>
                            <select required class="form-control" name="categoria">
                                <option value="-1" selected>Todas Categorias</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="dataInicial">Data Inicial</label>
                            <input type="date" name="dataInicial" class="form-control" required>
                        </div>
                        <div class="form-group col-3">
                            <label for="dataFinal">Data Final</label>
                            <input type="date" name="dataFinal" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <button type="submit" name="btn" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                        </div>
                    </div>
                        
                    </div>
                </form>


    <thead class="">
        
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Data</th>
            <th scope="col">Detalhes</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
    </tfoot>
</table>
@endsection