@extends('template')
@section('title', 'Produtos em Estoque')
@section('content')
<div class="container">
        <div class="card text-center">
            <div class="card-header">
                <h5>Produtos em estoque</h5>
            </div>
            <div class="card-body">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link  active" href="#">Inicial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">Relatorios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info " href="#">Tipos de Unidade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info " href="#">configurações</a>
                </li>
            </ul>
            <form action="{{url($data['url'])}}" method="POST">
        @csrf
        @if(isset($categoria))
            @method('put')
        @endif
        <div class="row">
        <div class="col-4">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select class="custom-select" id="categoriaPai" name="categoriaPai">
                    <option value="-1">Selecione</option>
                   
                    <option value=""></option>
                   
                </select>
                
                   
               
                </div>
            </div>
       
                <div class="form-group col-8">
                    <label for="nome">Nome</label>
                    <input type="text" name='nome' id="nome" class="form-control" maxlength="45" value="{{(isset($categoria))?$categoria->nome:''}}">
                    <p class=" alert-warning">  </p>
                </div>
                </div>
              
            <div class="row col-12" style="justify-content: flex-end;">
                <button type="submit" id="enviar" class="btn btn-primary"></button>
            </div>

        </form>  

            </div>
                <div class="card-footer">


                </div>

        </div>
    </div>



@endsection
