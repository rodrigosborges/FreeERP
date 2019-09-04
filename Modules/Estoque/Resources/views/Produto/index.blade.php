@extends('estoque::template')
@section('title', 'Lista de Produtos')
@section('content')
<div class="container">

  <div class="col-12 mt-3">
    <form method="POST" action="{{url('/estoque/produto/busca')}}" id="form">
      @csrf
      <div class="form-group">
        <div class="input-group">
            <div class="col-6">
                <input id="search-input" placeholder="Insira o nome do produto" class="form-control" type="text" name="pesquisa" />
            </div>
            </div>
            <div class="col-4">
                <select class="form-control" name="categoria_id">
                <option value="-1">Todas Categorias</option>
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-dark material-icons ml-1"><i id="search-button">search</i></button>
            </div>
        </div>
    </form>
</div>
  </div>
  <div class="col-12 mb-3">
    <div class="text-right">
      <a class="btn btn-success" href="{{url('/estoque/produto/create')}}">Novo Produto</a>
    </div>
  </div>
  <div class="card col-md-12">
    <div class="header">
      <h3 class="text-center">Produto</h3>
    </div>
    <div class="card-body">
      <ul class="nav nav-tabs  justify-content-center">
        <li class="nav-item">
          <a href="#ativos" class="nav-link active" role="tab" data-toggle="tab">
          Produtos Ativos
          </a>
        </li>
        <li class="nav-item">
          <a href="#inativos" class="nav-link" role="tab" data-toggle="tab">
          Produtos Inativos
          </a>
        </li>
      </ul>
      <div class=" tab-content row justify-content-center ">
        <div class="tab-pane active col-sm-10" role="tabpanel1" id="ativos">
          <table class="table mt-3">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço</th>
                <th scope="col">Editar</th>
                <th scope="col">Deletar</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($produtos))
              @foreach($produtos as $produto)
              <tr>
                <td>{{$produto->nome}}</td>
                <td>{{$produto->quantidade}}</td>
                <td>R$ {{$produto->preco}}</td>
                <td style="display: flex; flex-direction: row;"><a href="{{url('/estoque/produto/' . $produto->id . '/edit')}}"><button class="btn btn-warning">Editar</button></a></td>
                <td>
                  <form method="POST" action="{{url('/estoque/produto/' . $produto->id)}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Desativar</button>
                  </form>
                </td>
              </tr>
              @endforeach 
              @endif 
            </tbody>
            <tfoot>
              <tr>
                <td colspan="100%" class="text-center">
                  <p class="text-cetner">
                    Página {{$produtos->currentPage()}} de {{$produtos->lastPage()}}
                    -Exibido {{$produtos->perPage()}} registro(s) por página de {{$produtos->total()}}
                  </p>
                </td>
              </tr>
              @if($produtos->lastPage() > 1)
              <tr>
                <td colspan="100%" class="text-center">
                  {{ $produtos->links() }}
                </td>
              </tr>
              @endif
            </tfoot>
          </table>
        </div>
        <div class="tab-pane col-sm-10" role="tabpanel1" id="inativos">
          <div class="justify-content-center">
            <table class="table mt-3">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Quantidade</th>
                  <th scope="col">Preço</th>
                  <th scope="col">Restaurar</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($produtosInativos))
                @foreach($produtosInativos as $produto)
                <tr>
                  <td>{{$produto->nome}}</td>
                  <td>{{$produto->quantidade}}</td>
                  <td>R$ {{$produto->preco}}</td>
                  <td>
                    <form method="POST" action="{{url('/estoque/produto/' . $produto->id. '/restore')}}">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-primary">Restaurar</button>
                  </td>
                </tr>
                @endforeach 
                @endif 
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="100%" class="text-center">
                    <p class="text-cetner">
                      Página {{$produtosInativos->currentPage()}} de {{$produtosInativos->lastPage()}}
                      -Exibido {{$produtosInativos->perPage()}} registro(s) por página de {{$produtosInativos->total()}}
                    </p>
                  </td>
                </tr>
                @if($produtosInativos->lastPage() > 1)
                <tr>
                  <td colspan="100%" class="text-center">
                    {{ $produtosInativos>links() }}
                  </td>
                </tr>
                @endif
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection