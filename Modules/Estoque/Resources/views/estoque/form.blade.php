@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Estoque')
@section('body')


<form action="{{url($data['url'])}}" method="POST" class="estoqueForm">
    @csrf
    @if(isset($data['estoque']))
    @method('put')
    @endif
    <p class="feedback-errors alert"></p>
    <div class="row">

        <div class="col-lg-6  col-md-6 col-sm-6">
            <div class="form-group">
                <label for="categoria_id">Produto</label>
                @if($data['estoque'])
                <input type="text" disabled="disabled" class="form-control" value ="{{$data['estoque']->produtos->last()->nome}}">
                @else
                <select class="custom-select produto_id" id="produto_id" name="produto_id">
                    <option value="-1">Selecione</option>
                    @foreach($data['produtos'] as $produto)
                    <option value="{{$produto->id}}" {{isset($data['estoque']) && $data['produto']->id==$produto->id?'selected':''}}>{{$produto->nome}}</option>
                    @endforeach
                </select>
                @endif
            </div>
        </div>

        <div class="col-lg-6  col-md-6 col-sm-6">
            <div class="form-group">
                <label for="categoria_id">Tipo de Unidade</label>
                <select class="custom-select tipo_unidade_id" id="tipo_unidade_id" name="tipo_unidade_id">
                    <option value="-1">Selecione um produto</option>
                    @foreach($data['tipoUnidade'] as $unidade)
                    <option value="{{$unidade->id}}"  {{isset($data['estoque']) && $data['estoque']->tipo_unidade_id==$unidade->id?'selected':''}}>{{$unidade->nome}} ({{$unidade->quantidade_itens}} itens) </option>
                    @endforeach

                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="form-group">
                <label for="preco_custo">Preço de Custo</label>
                <input type="text" name="preco_custo" id="preco_custo" value=" {{isset($data['estoque'])?$data['estoque']->movimentacaoEstoque->last()->preco_custo:''}}" placeholder="R$" onkeyUp="moeda(this);" class="form-control preco_custo" required>
            </div>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-4">
            <label for="nome">Quantidade</label>
            <input type="{{isset($data['estoque'])?'text':'number'}}" placeholder="Insira a quantidade" name='quantidade' required id="quantidade" class="form-control quantidade" maxlength="45" value=" {{isset($data['estoque'])?(int)$data['estoque']->quantidade:''}}">
            <p class=" alert" id="mensagem-nome"> {{$errors->first('quantidade')}}</p>
        </div>

        <div class="form-group col-4">
            <label for="quantidade_notificacao">Notificar estoque abaixo de:</label>
            <input type="number" class="form-control" name="quantidade_notificacao" value="{{isset($data['estoque']) ? $data['estoque']->quantidade_notificacao : ''}}" placeholder="Insira a quantidade" required>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <button type="submit" id="send" class="btn btn-primary send">{{$data['button']}}</button>
        </div>
    </div>

</form>
@endsection
@section('js')

<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        if ($('.produto_id').val() == -1) {
            $('.tipo_unidade_id').html('');
        }
    })
    $('.feedback-errors').hide();
    $('.send').click(function(event) {
        event.preventDefault();
        var error = false;
        var message = "";
        if ($('.produto_id').val() == -1) {
            error = true;
            message += "Selecione um produto<br>";
            $('.produto_id').focus()
        }
        if ($('.tipo_unidade_id').val() == -1) {
            error = true;
            message += "\n Selecione um tipo de unidade<br>";
            $('.tipo_unidade_id').focus()
        }
        if ($('.preco').val() == "") {
            error = true;
            message += "\n O Campo preço de custo é obrigatório<br>";
            $('.preco_custo').focus()
        }
        if ($('.quantidade').val() == "") {
            error = true;
            message += "\n O campo quantidade é obrigatório<br>";
            $('.quantidade').focus()
        } else if ($('.quantidade').val() <= 0) {
            error = true;
            message += "\n A Quantidade não pode ser menor ou igual a 0";
            $('.quantidade').focus()
        }
        if (!error) {
            $('.feedback-errors').hide()
            $('.feedback-errors').removeClass('alert-warning')
            $('.feedback-errors').addClass('alert-primary')
            $('.feedback-errors').fadeIn()
            $('.feedback-errors').html("processando...")
            $('.send').attr('disabled', true)
            $('.estoqueForm').submit();
        } else {
            $('.feedback-errors').fadeIn()
            $('.feedback-errors').html(message)
            $('.feedback-errors').addClass('alert-warning')
        }

    })
    $('.produto_id').change(function() {
        var idProduto = $('.produto_id').val();
        if (idProduto != -1)
            buscaUnidade(idProduto)
    })

    function buscaUnidade(id) {
        $.ajax({
            url: '/buscaUnidades',
            type: "POST",
            data: {
                id: id,
                '_token': $('input[name=_token]').val(),
            }
        }).done(function(e) {
            console.log("Ok:" + e);
            var options = "<option value ='-1'>Selecione</option>"
            var data = $.parseJSON(e);
            console.log("Data:" + data)
            $.each(data, function(cahve, valor) {
                options += "<option value='" + valor.id + "'>" + valor.nome + "(" + valor.quantidade_itens + " itens)</option>"
            })
            $('.tipo_unidade_id').html(options);
            // console.log(options)
        }).fail(function() {
            console.log('Fail')
        }).always(function() {

        })
    }
</script>
<script>
    function moeda(i) {
        var v = i.value.replace(/\D/g, '');
        v = (v / 100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    }
</script>
@endsection