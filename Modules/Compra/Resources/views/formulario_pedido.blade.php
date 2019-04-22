@extends('template')
@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif
       
        <label for="item" class="control-label">Itens</label>
        
        <div class="form-group">

            @foreach($data['itens_pedido'] as $itemPedido)
                <div class="input-group">
                    <select required name="itens[]" class="form-control">
                        <option value="">Selecione uma opção</option>
                        @foreach($data['itens'] as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $itemPedido['id'] ? 'selected' : '' }}> {{ $item->nome_produto }} </option>
                        @endforeach
                    </select>
                        <input type="number" placeholder="Quantidade" name="quantidade" id="quantidade" class="form-control" value="{{ $data['model'] ? $data['model']->quantidade : old('quantidade', "") }}">
                        <label class="errors"> {{ $errors->first('quantidade') }} </label>
                        <label type="hidden" name='status' value="iniciado">
                    <button type="button" class="btn btn-danger remover">Remover</button>
                </div>
            @endforeach
        </div>

        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-success" id="adicionar">Adicionar</button>
            
        </div>
        <button type="submit" class="btn btn-primary my-1">Enviar</button>
    </form>

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