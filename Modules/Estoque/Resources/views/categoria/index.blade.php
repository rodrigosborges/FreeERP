@extends('template')
@section('title','Categorias')
@section('content')
<h1 class="text-center">Categorias</h1>
    <div class="row justify-content-center "  >
    
    <div class="col-sm-6 d-flex" >
    <table border=1 class="table text-center ">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope='col' colspan='2'>Ações</th>
        </tr>
        </thead>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{$categoria->id}}</td>
            <td>{{$categoria->nome}}</td>
            <td>
               <a  class="btn btn-lg btn-warning" href="{{url('estoque/produto/categoria/'.$categoria->id. '/edit')}}">
                    <i class="material-icons">border_color</i>
                    </a>
                
            </td>
            <td>
                <a class="btn btn-lg btn-danger" href="">
                    <i class="material-icons">delete</i>
                </a>
            </td>
            
        </tr>
        @endforeach
    </table>
    </div>
    
</div>
@endsection