@extends('template')
@section('content')
    <div class="row justify-content-center">                     
        <div class="card col-7"> 
            <div class="card-body">
                <form action="{{ $data['url'] }}" method="POST" class="col-12">
                    {{ csrf_field() }}
                    @if($data['pedido'])
                        @method('PUT')
                    @endif
                    <h2 class="card-title mt-3 ml-2">Itens</h2>
                    <div class="form-group">
                        @foreach($data['itens_pedido'] as  $key => $itemPedido)
                            <div class="input-group mt-2">
                                <select required name="itens[{{$key}}][item_compra_id]" class="form-control col-7">
                                    <option value="">Selecione uma opção</option>
                                    @foreach($data['itens'] as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $itemPedido['id'] ? 'selected' : '' }}> {{ $item->nome }} </option>
                                    @endforeach
                                </select>
                                <div class="col-3"><input class="form-control" required value="{{ $data['pedido'] ? $itemPedido->pivot->quantidade: old('quantidade', "") }}" type="number" placeholder="Quantidade" name="itens[{{$key}}][quantidade]" onKeyPress="PermiteNumeros();"></div>
                                <button type="button" class="btn btn-danger remover">Remover</button>              
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-success" id="adicionar">Adicionar</button>
                    </div>
                    <button type="submit" class="btn btn-primary my-1">Enviar</button>
                </form>
            </div>     
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#adicionar").on("click", function(){
                //div que irá ser clonada
                var div = $("[name='itens[{{$key}}][item_compra_id]").first().closest(".input-group").clone()
                
                //atribuindo index do name do input do item
                var i = $('.input-group').length-1; 
                div.find("select").attr('name','itens['+(i+1)+'][item_compra_id]')
                div.find("input").attr('name','itens['+(i+1)+'][quantidade]')
                //zerando valores dos campos
                div.last().find("input").val("")
                div.last().find("select").val("")
                div.appendTo($(".form-group"))
                $(".remover").on("click", function(){
                    if($(".input-group").length > 1)
                            $(this).parent().remove();
                })
            })
            $(".remover").on("click", function(){
                if($(".input-group").length > 1)
                    $(this).parent().remove();
            })
        })

    </script>
@endsection

<SCRIPT LANGUAGE="JavaScript">
function PermiteNumeros()
{
  var tecla = window.event.keyCode;
  tecla     = String.fromCharCode(tecla);
  if(!((tecla >= "0") && (tecla <= "9")))
  {
    window.event.keyCode = 0;
  }
}
</script>