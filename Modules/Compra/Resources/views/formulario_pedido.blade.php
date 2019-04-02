@extends('template')
@section('content')
                
    <form action="{{ $data['url'] }}" method="POST">
        {{ csrf_field() }}
        @if($data['model'])
            @method('PUT')
        @endif
       
    <label for="item" class="control-label">Itens</label>
        <div class="item-select">
                <div class="form-group">
                    <div class="input-group">
                    <select required name="itens[]" class="form-control">
                            <option value="">Selecione uma opção</option>
                            @foreach($data['itens'] as $item)
                            <option value="{{ $item->id }}" {{ ( $data['model'] && $item->id == $data['model']->id ) ? 'selected' : '' }}> {{ $item->nome_produto }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>


        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-success" id="adicionar">Adicionar</button>
            <button type="button" class="btn btn-danger" id="remover">Remover</button>
        </div>
        <button type="submit" class="btn btn-primary my-1">Enviar</button>
    </form>






    
    


@endsection
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
        $("#adicionar").on("click", function(){
            var div = $(".item-select .form-group").first().clone()
            div.find("select").val("")
            div.appendTo($(".item-select"))
        })
        $("#remover").on("click", function(){
            if($(".item-select .form-group").length > 1)
                $(".item-select .form-group").last().remove()
        })
</script>