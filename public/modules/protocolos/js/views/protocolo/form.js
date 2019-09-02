$('#pesquisa').keyup(function(){
    var query = $(this).val();

    if(query != ''){
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: " {route('protocolos.fetch') }",
            method: "POST",
            data: {query:query, _token:_token},
            sucess:function(data){
                $('#interessados_list').fadeIn();
                $('#interessados_list').html(data);
            }
        })
    }

})