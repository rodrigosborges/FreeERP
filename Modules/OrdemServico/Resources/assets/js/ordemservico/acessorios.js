$(document).ready(function () {
    $("#acessorios").focus(function(){
        $(this).css('outline','none');
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
            var valor = $(this).val();
            $(this).val('');
            $(this).parent().prepend("<span class='badge badge-primary'>" + valor + "</span>");

        }
    });
   
});
