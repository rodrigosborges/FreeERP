<?php 
    $moduleInfo = [
        'icon' => 'fastfood',
        'name' => 'Estoque',
    ];
    $menu = [
        ['icon' => 'people', 'tool' => 'Produto', 'route' => url('')],
        ['icon' => 'work', 'tool' => 'Categoria', 'route' => url('')],
    ];
?>

@extends('template')
@section('title', 'Cadastro de Produto')

@section('content')
<form action="{{url('/produto/cadastrar')}}" method="POST">
    @csrf
    <div class="container" style="justify-content: center">
        <div class="row">
            <div class="col-5">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input required type="text" name="nome" class="form-control">
                    {{$errors->first('nome')}}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select required class="form-control" name="categoria_estoque_id">
                        <!-- INSERIR FOREACH CATEGORIAS -->
                        <option value="1">Categoria 1</option>
                    </select>
                    {{$errors->first('categoria_id')}}
                </div>
            </div>
        </div>
            <div class="row" style="align-items: flex-start;">
                <div class="form-group col-5">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3" required></textarea>
                    {{$errors->first('descricao')}}
                </div>
                <div class="col-3">
                <div class="form-group">
                    <label for="preco_venda">Preço de Venda</label>
                    <input type="text" name="preco_venda" class="form-control" required>
                    {{$errors->first('preco_venda')}}
                </div>
            </div>
            </div>
            <div class="row col-8" style="justify-content: flex-end;">
                <button type="submit" class="btn btn-primary">{{isset($produto) ? 'Salvar' : 'Cadastrar'}}</button>
            </div>
        </form>  
    </div>  
@endsection