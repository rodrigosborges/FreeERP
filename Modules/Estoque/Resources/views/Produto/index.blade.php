@extends('estoque::template')
@section('title', 'Lista de Produtos')
@section('content')
<div class="container">
<div class="row">
        <div class="col-md-8 mt-3">
                
            <form method="POST" action="{{url('/estoque/produto/busca')}}" id="form">
            @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input id="search-input" placeholder="Pesquisa" class="form-control" type="text" name="pesquisa" />
                        <button type="submit" class="btn btn-dark material-icons ml-1"><i id="search-button">search</i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 mt-3">
            <div class="text-right">
                <a class="btn btn-success" href="{{url('/estoque/produto/create')}}">Novo Produto</a>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <h1>{{$title}}</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço</th>
                @if($flag == true)
                    <th scope="col">Restaurar</th>
                @else
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                @endif
                </tr>
            </thead>
            <tbody>
                 @if(isset($produtos))
                @foreach($produtos as $produto)
                <tr>    
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->quantidade}}</td>
                    <td>R$ {{$produto->preco_venda}}</td>
                    
                    @if($flag == true)
                    <td> <form method="POST" action="{{url('/estoque/produto/' . $produto->id. '/restore')}}">
                     @method('put')
                     @csrf
                <button type="submit" class="btn btn-primary">Restaurar</button>
            </form>
            </td>
                    @else
                    <td style="display: flex; flex-direction: row;"><a href="{{url('/estoque/produto/' . $produto->id . '/edit')}}"><button class="btn btn-warning">Editar</button></a></td>
                    <td>
                    <form method="POST" action="{{url('/estoque/produto/' . $produto->id)}}">
                     @method('delete')
                     @csrf
                <button type="submit" class="btn btn-danger">Desativar</button>
            </form>
            </td>

                    @endif

                </tr>
                @endforeach 
                @endif 

           
            </tbody>
        </table>
    </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script>
    $("#form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        
        $.ajax({
            type: "POST",
            url: "{{ url('estoque/produto/busca') }}",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log('foi')
            }
            });
        });
</script> -->
@endsection
