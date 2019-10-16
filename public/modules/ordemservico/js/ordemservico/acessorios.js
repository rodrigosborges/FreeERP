$(document).ready(function () {
    var acessorios = [];
    $('#acessorios').val('');

    $("#acessorios").focus(function () {
        $(this).css('outline', 'none');
    });

    $('.acessorios').click(function () {
        $('#acessorios').focus();
    });

    $(document).on("keypress", 'form', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });
    $(document).on("keypress", '#acessorios', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            if ($('.acessorios').find('.input-group-prepend').children().length < 5) {
                var valor = $(this).val();
                $(this).val('');
                $(this).prev().append("<span class='mr-1 p-2 badge badge-primary'>" + valor + " <span class='ml-2 remover-badge'> x </span> </span>");
            }
            else {
                mostraDialogo('Só é possível adicionar 5 Acessórios', 'warning', 3000);
                $(this).val('');
            }

        }
    });

    $(document).on('click', '.remover-badge', function () {
        $(this).parent().remove();
    });

    $(document).on('click', '.btn-success', function () {
        var elementos = $('.acessorios').find('.input-group-prepend');
        for (i = 0; i < elementos.children().length; i++) {
            var elemento = (elementos.children().eq(i).html());
            acessorios.push(elemento.substring(0,elemento.indexOf(" ")));
        }
        $('#acessorios').val(acessorios);
    });

    function mostraDialogo(mensagem, tipo, tempo) {

        // se houver outro alert desse sendo exibido, cancela essa requisição
        if ($("#message").is(":visible")) {
            return false;
        }

        // se não setar o tempo, o padrão é 3 segundos
        if (!tempo) {
            var tempo = 3000;
        }

        // se não setar o tipo, o padrão é alert-info
        if (!tipo) {
            var tipo = "info";
        }

        // monta o css da mensagem para que fique flutuando na frente de todos elementos da página
        var cssMessage = "display: block; position: fixed; top: 0; left: 20%; right: 20%; width: 60%; padding-top: 10px; z-index: 9999";
        var cssInner = "margin: 0 auto; box-shadow: 1px 1px 5px black;";

        // monta o html da mensagem com Bootstrap
        var dialogo = "";
        dialogo += '<div id="message" style="' + cssMessage + '">';
        dialogo += '    <div class="alert alert-' + tipo + ' alert-dismissable" style="' + cssInner + '">';
        dialogo += '    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
        dialogo += mensagem;
        dialogo += '    </div>';
        dialogo += '</div>';

        // adiciona ao body a mensagem com o efeito de fade
        $("body").append(dialogo);
        $("#message").hide();
        $("#message").fadeIn(200);

        // contador de tempo para a mensagem sumir
        setTimeout(function () {
            $('#message').fadeOut(300, function () {
                $(this).remove();
            });
        }, tempo); // milliseconds

    }
});

