@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Estoque')
@section('body')


<form action="{{url($data['url'])}}" method="POST" class="estoqueForm">
    @csrf
    @if(isset($estoque))
    @method('put')
    @endif
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="categoria_id">Produto</label>
                <select class="custom-select" id="produto_id" name="produto_id">
                    <option value="-1">Selecione</option>
                    @foreach($data['produtos'] as $produto)
                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="categoria_id">Tipo Unidade</label>
                <select class="custom-select" id="tipo_unidade_id" name="tipo_unidade_id">
                    <option value="-1">Selecione</option>
                    @foreach($data['tipoUnidade'] as $unidade)
                    <option value="{{$unidade->id}}">{{$unidade->nome . ' - ' .$unidade->quantidade_itens. ' itens' }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-2">
                <div class="form-group">
                    <label for="preco_custo">Preço de Custo</label>
                    <input type="text" name="preco_custo" id="preco_custo" placeholder="R$" onkeyUp="moeda(this);" class="form-control" required>
                </div>
        </div>

        <div class="form-group col-3">
            <label for="nome">Quantidade</label>
            <input type="number" name='quantidade' required id="quantidade" class="form-control" maxlength="45" value="{{(isset($estoque))?$categoria->nome:''}}">
            <p class=" alert" id="mensagem-nome"> {{$errors->first('quantidade')}}</p>
        </div>

    </div>
    <div class="row col-12" style="justify-content: flex-end;">
        <button type="submit" id="send" class="btn btn-primary">{{$data['button']}}</button>
    </div>

</form>
@endsection
@section('js')
<script type="text/javascript">
    $('#send').click(function(event) {
        event.preventDefault();
        var error = false;
        var message = "";
        if ($('#produto_id').val() == -1) {
            error = true;
            message += "Selecione um produto";
            $('#produto_id').focus()
        }
        if ($('#tipo_unidade_id').val() == -1) {
            error = true;
            message += "\n Selecione um tipo de unidade";
            $('#tipo_unidade_id').focus()
        }
        if ($('#preco').val() == ""){
            error = true;
            message += "\n O Campo preço de custo é obrigatório";
            $('#preco_custo').focus()
        }
        if ($('#quantidade').val() == "") {
            error = true;
            message += "\n O campo quantidade é obrigatório";
            $('#quantidade').focus()
        } else if ($('#quantidade').val() <= 0) {
            error = true;
            message += "\n A Quantidade não pode ser menor ou igual a 0";
            $('#quantidade').focus()
        }
        if (!error) {
            $('.estoqueForm').submit();
        }
        console.log(message);
    })
</script>
<script>
    function moeda(i) {
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    }
</script>
@endsection