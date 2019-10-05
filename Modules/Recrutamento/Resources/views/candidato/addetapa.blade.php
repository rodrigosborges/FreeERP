@extends('template')
@section('content')
    
<div class="row justify-content-center">                     
        <div class="card col-7"> 
        <h2 class="card-header">Adicionar Etapas</h2>
            <div class="card-body">
                <form action="{{ $data['url'] }}" method="POST" class="col-12">
                    {{ csrf_field() }}
                    @if($data['pedido'])
                        @method('PUT')
                    @endif
                    
                    <div class="form-group">
                        @foreach($data['itens_pedido'] as  $key => $itemPedido)
                            <div class="input-group mt-2">
                                <div class="col-sm-7">
                                <label for="etapa">Etapa</label>
                                <select required name="itens[{{$key}}][etapa_id]" id="etapa" class="form-control">
                                    <option value="">Selecione uma opção</option>
                                    @foreach($data['itens'] as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $itemPedido['id'] ? 'selected' : '' }}> {{ $item->nome }} </option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="nota">Nota</label>
                                    <input class="form-control" id="nota" required value="{{ $data['pedido'] ? $itemPedido->pivot->nota: old('nota', "") }}" type="number" placeholder="Nota" name="itens[{{$key}}][nota]" onKeyPress="PermiteNumeros();">
                                </div>
                                
                                    <button type="button" class="btn btn-danger btn-small remover mt-4" >Remover</button>              
                                
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-success" id="adicionar">Adicionar</button>
                    </div>
                    
                    <input type="hidden" name="candidato_id" value="{{$data['candidato']->id}}" >
                    <a href="{{$data['voltar']}}"  class="btn btn-secondary mt-3 float-left">Cancelar</a>
                    <button type="submit" class="btn btn-primary mt-3 float-right">Salvar</button>

                </form>
            </div>     
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script>
    $( document ).ready(function() {

        $("#adicionar").on("click", function(){
                //div que irá ser clonada
                var div = $("[name='itens[{{$key}}][etapa_id]").first().closest(".input-group").clone()
                
                //atribuindo index do name do input do item
                var i = $('.input-group').length-1; 
                div.find("select").attr('name','itens['+(i+1)+'][etapa_id]')
                div.find("input").attr('name','itens['+(i+1)+'][nota]')
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
    });
</script>