@extends('template')
@section('title','Categorias')
@section('content')
<h1 class="text-center">Categorias</h1>
<div class="row justify-content-center ">

    <div class="col-sm-12 d-flex">
    
        <table class="table text-center ">
        
            <thead class="thead-dark">
      
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope='col' >Ações</th>
                    <th><a class="btn btn-success btn-md"  href="{{url('/estoque/produto/categoria/create')}}"><i class="material-icons">
note_add
</i></a></th>
                </tr>
            </thead>
            @foreach($categorias as $categoria)
            <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->nome}}</td>
                <td>
                    <a class="btn btn-lg btn-warning" href="{{url('estoque/produto/categoria/'.$categoria->id. '/edit')}}">
                        <i class="material-icons">border_color</i>
                    </a>

                </td>
                <td>
                    <form method="POST" action="{{url('estoque/produto/categoria/'. $categoria->id)}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-lg btn-danger">

                            <i class="material-icons">delete</i>

                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<hr>
<h2 class='text-center'>Categorias Inativas</h2>
<div class="row justify-content-center">
    <div class="col-sm-12 d-flex text-center">
        <table class="table">
            <thead class="table-dark">
                <td>id</td>
                <td>nome</td>
                <td>Ação</td>
            </thead>
            @foreach($categoriasInativas as $inativa)
            <tr>
                <td>{{$inativa->id}}</td>
                <td>{{$inativa->nome}}</td>
                <td>
                    <form method="POST" action="{{url('estoque/produto/categoria/restore/'.$inativa->id)}}">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-info">Restaurar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection