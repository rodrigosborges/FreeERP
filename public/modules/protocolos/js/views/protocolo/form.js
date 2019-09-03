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
               
                // for(i=0; i<=data.length; i++){
                //     console.log(data[i]['nome'])
                //     termos[i] = data[i]['nome']
                // }
                $('#pesquisa').autocomplete({
                    source: data
                })
                // $('#interessados_list').fadeIn();
                // $('#interessados_list').html(data);
            }
        })
    }

})