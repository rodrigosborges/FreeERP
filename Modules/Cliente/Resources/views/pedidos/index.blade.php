@extends('cliente::template')
@section('title','Cadastro de Pedidos')

@section('body')
<div class = "container border">

    <div id="nome_cliente" class="row align-items-center pb-2 pl-2 col-sm-12">
       <div class="col-sm-4">Cliente Selecionado</div>
       <div class= "col-sm-4"><h4>{{ $cliente[0]->nome }}</h4></div>
    </div>
  
      <div id="opcoes" class="row d-flex p-2 justify-content-around">
          <button class="btn btn-primary col-md-3">Adicionar Compra</button>
          <button class="btn btn-danger col-md-3">Excluir</button>
          <button class="btn btn-warning col-md-3">Editar</button>
      </div>
  
      <div class="row p-2" id="tabela">
          <table class="table table-dark bordered text-center col-md-12">
              <thead>
                <tr>
                  <th scope="col">Num_Pedido</th>
                  <th scope="col-2">Data</th>
                  <th scope="col-2  ">Valor</th>
                  <th scope="col-2">Vl_Desconto</th>
                  <th scope="col-2">Ver mais</th>
                  <th scope="col-2">
                    <div class="form-check col">
                      <input type="checkbox" class="form-check-input" id="select_todos">
                      <label class="form-check-label" for="select_todos">Selecionar Todos</label>
                    </div>
                  </th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($pd as $pedido)
                <tr>
                    <th scope="row">{{$pedido->id}}</th>
                        <td>{{$pedido->data}}</td>
                        <td>Calcular</td>
                        <td>{{$pedido->desconto}}</td>
                        <td>
                            <button id="ocultar" class="btn-primary" data-toggle="collapse" href="#collapseExample" 
                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="material-icons">
                                        format_list_bulleted
                                    </i>
                            </button>
                        </td>
                        <td class="d-flex justify-content-center">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
      </div>
  </div>
  <script>
    function ocultar(){
      document.getElementById("oculta").css('color','red');
    }
  
  
  </script>

@endsection

