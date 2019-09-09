$('#pesquisa').keyup(function(){
    var query = $(this).val();

    if(query != ''){
        // var _token = $('input[name="_token"]').val();

    

        $.ajax({
            url: main_url+'/protocolos/busca',
            method: "POST",
            data: {query:query},
            dataType: 'json',
            success:function(data){
                $('#pesquisa').autocomplete({
                    source: data,
                    select: function (e, i) {
                        document.getElementById("interessado").innerHTML = i.item.value
                    }
                })
            }
        })
    }

})