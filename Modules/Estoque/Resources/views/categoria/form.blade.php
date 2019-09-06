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
            <input type="hidden" name="categoriaId" id="categoria-id" value="{{isset($categoria)?$categoria->id:0}}">
            <label for="nome">Nome</label>
            <input type="text" name='nome' id="nome" class="form-control" maxlength="45" value="{{(isset($categoria))?$categoria->nome:''}}">
            <p class=" alert" id="mensagem-nome"> {{$errors->first('nome')}}</p>
        </div>
    </div>
    

    <div class="row col-12" style="justify-content: flex-end;">
        <button type="submit" id="enviar" class="btn btn-primary">{{$data['button']}}</button>
    </div>

</form>


@endsection
@section('js')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#mensagem-nome').fadeOut();

        function doneTyping() {
            $('#nome').css('opacity', '0.8');
            $('#enviar').attr('disabled', true);
            buscaNome()
        }
        $("#nome").bind('paste', function(e) {
            e.preventDefault();
        });

        var typingTimer; //timer identifier
        var doneTypingInterval = 1000;
        $("#nome").keyup(function(e) {
            $('#mensagem-nome').fadeOut();

            var string = $('#nome').val();
            var validator = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/

            if (!validator.test(string)) {
                $('#nome').val(string.substring(string.length - 1, 0));
                $('#nome').focus()
            }
            clearTimeout(typingTimer);
            if ($('#myInput').val) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
            var categoria = $('#categoria-id').val();


        })

    })

    function buscaNome() {
        var string = $('#nome').val();
        var categoria = $('#categoria-id').val()



        $.ajax({
            url: '/verificaNomeCategoria',
            type: 'post',
            data: {
                'nome': string,
                'categoria-id': categoria,
                '_token': $('input[name=_token]').val(),


            },
            dataType: 'json'

        }).done(function(data) {
            $('#nome').css('opacity', '1');

            console.log(data);
            var mensagem;
            if (data == 1) {
            //    alert('Ja tem');
                mensagem = "Esta categoria já está cadastrada"
                $('#mensagem-nome').removeClass('alert-success')
                $('#mensagem-nome').addClass('alert-warning')
            } else {
                $('#mensagem-nome').removeClass('alert-warning')
                $('#mensagem-nome').addClass('alert-success')
                mensagem = "Categoria disponível"
              //  alert('nome livre')
                $('#enviar').attr('disabled', false);
            }
            $('#mensagem-nome').html(mensagem)
            $('#mensagem-nome').fadeIn()
            
        }).fail(function() {
            console.log('fail')
        })
    }
</script>
@endsection