@extends('template')
@section('content')
<div class="row justify-content-center">                     
   <div class="card col-7">
      

      <h2 class="card-title mt-3 ml-2">Envio de Orçamentos</h2>

      <h2 class="card-title mt-3 ml-2">Itens</h2>
      <form action="{{ $data['url'] }}" method="POST">
        

         @foreach($data['itens_pedido'] as $itemPedido)
         <div class="input-group mt-2">
            <div class="form-check form-check-inline mx-sm-3">
            <input class="form-check-input" type="checkbox" id="{{$itemPedido->nome_produto}}" value="{{$itemPedido->nome_produto}}">
            <label class="form-check-label" for="{{$itemPedido->nome_produto}}"><h4>{{$itemPedido->nome_produto}}</h4></label>
            </div>
         </div>
         @endforeach

      <br>
      <h2>Fornecedores</h2>
      <div class="form-group">
         <div class="input-group mt-3">
            <select required name="fornecedores[]" class="form-control col-7 mx-sm-3">
            <option value="">Selecione uma opção</option>
            @foreach($data['fornecedores'] as $fornecedor)
               <option value="{{ $fornecedor->id }}"> {{ $fornecedor->nome_fornecedor}} </option>
            @endforeach                                   
            </select>
            <button type="button" class="btn btn-danger remover mb-4 ">Remover</button>
                  
         
      </div>
      <button type="button" class="btn btn-success" id="adicionar">Adicionar</button>
      <div class="col-md-12 text-center">
         
      </div>
      </form>
      <button type="submit" class="btn btn-primary">Enviar</button>
         
      </div>
      
   </div>
</div>


@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#adicionar").on("click", function(){
                var div = $("[name='fornecedores[]']").first().closest(".input-group").clone()
                div.find("select").val("")
                div.appendTo($(".form-group"))
                $(".remover").on("click", function(){
                    if($("[name='fornecedores[]']").length > 1)
                            $(this).parent().remove();
                })
            })
            $(".remover").on("click", function(){
                if($("[name='fornecedores[]']").length > 1)
                    $(this).parent().remove();
            })
        })

    </script>
@endsection