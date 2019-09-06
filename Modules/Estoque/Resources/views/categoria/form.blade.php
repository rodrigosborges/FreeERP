@extends('estoque::template2')
@section('title','Categorias')
@section('body')
<form action="{{url($data['url'])}}" method="POST">
    @csrf
    @if(isset($categoria))
    @method('put')
    @endif
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="categoria_id">Categoria</label>
                <select class="custom-select" id="categoriaPai" name="categoriaPai">
                    <option value="-1">Selecione</option>
                    @foreach($categorias as $cat)
                    <option value="{{$cat->id}}" {{isset($categoria)&&$subcategoria->categoria_id== $cat->id?'selected':''}}>{{$cat->nome}}</option>
                    @endforeach
                </select>


                {{$errors->first('categoria_id')}}
            </div>
        </div>

        <div class="form-group col-8">
            <input type="hidden" id="categoria-id" value="{{isset($categoria)?$categoria->id:0}}">
            <label for="nome">Nome</label>
            <input type="text" name='nome' id="nome" class="form-control" maxlength="45" value="{{(isset($categoria))?$categoria->nome:''}}">
            <p class=" alert-warning"> {{$errors->first('nome')}}</p>
        </div>
    </div>

    <div class="row col-12" style="justify-content: flex-end;">
        <button type="submit" id="enviar" class="btn btn-primary">{{$data['button']}}</button>
    </div>

</form>


@endsection
@section('js')
<script>
    $(document).ready(function() {
        $("#nome").bind('paste', function(e) {
            e.preventDefault();
        });
        $("#nome").keyup(function(e) {
            var string = $('#nome').val();
            var validator = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/

            if (!validator.test(string)) {


                $('#nome').val(string.substring(string.length - 1, 0));
                $('#nome').focus()
            }
            
         
        })
        var categoria = $('#categoria-id').val();
    
    })
</script>
@endsection