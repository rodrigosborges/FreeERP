var id;

$('#pesquisaProtocolos').keyup(function(){
    var query = $(this).val();

    if(query != ''){

        $.ajax({
            url: main_url+'/protocolos/buscaProtocolos',
            method: "POST",
            data: {query:query},
            dataType: 'json',
            success:function(data){
                
                $('#pesquisa').autocomplete({
                    source: data,
                    
                })
                
            }
            
        })

    }

})

$(document).on("click", ".trash", function() {

    $(this).parent().remove()

    let id = $(this).parent().find('span').data('id')
    console.log('ID do abençoado: '+id)

    let index = ids.indexOf(id)

    if(index > -1){
        ids.splice(index,1)
    }

    console.log(ids);
})



