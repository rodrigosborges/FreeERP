@extends('template')
@section('content')
    <div class="row justify-content-center">
        <div class="card col-7"> 
            
                <h2 class="card-title mt-3 ml-2">Itens</h2>

            
            <div class="card-body">
                <form action="{{ $data['url'] }}" method="POST" class="col-12">
                    {{ csrf_field() }}
                    @if($data['model'])
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        @foreach($data['itens_pedido'] as $itemPedido)
                            <div class="input-group mt-2">
                                <select required name="itens[]" class="form-control col-7">
                                    <option value="">Selecione uma opção</option>
                                    @foreach($data['itens'] as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $itemPedido['id'] ? 'selected' : '' }}> {{ $item->nome_produto }} </option>
                                    @endforeach
                                </select>
                                <div class="col-3"><input class="form-control" type="number" placeholder="Quantidade" name="quantidade" onKeyPress="PermiteNumeros();"></div>
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
                var div = $("[name='itens[]']").first().closest(".input-group").clone()
                div.find("select").val("")
                div.appendTo($(".form-group"))
                $(".remover").on("click", function(){
                    if($("[name='itens[]']").length > 1)
                            $(this).parent().remove();
                })
            })
            $(".remover").on("click", function(){
                if($("[name='itens[]']").length > 1)
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