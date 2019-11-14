var ids = []
var idprotocolo = document.getElementById('id-protocolo').value;

$('#pesquisa').keyup(function(){
    var query = $(this).val();
    console.log(query);
    if(query != ''){

        $.ajax({
            url: main_url+'/protocolos/buscaApensado',
            method: "POST",
            data: {query:query},
            dataType: 'json',
            success:function(data){
                
                $('#pesquisa').autocomplete({
                    source: data,
                  
                    select: function (e, i) {

                        var idapensado = i.item.value;

                        $.ajax({
                           url: main_url+'/protocolos/salvarApensado/'+idprotocolo,
                           method: "POST",
                           data: {id:idprotocolo, apensado:idapensado},
                           dataType: 'html',
                           success:function(response){
                            var obj = JSON.parse(response);

                            window.location.reload()

                            $("#pesquisa").val('')
                            return false
                            

                           },
                           error: function(e) {
                                console.log(e);
                           }
                        });
                        

   
                    }
                    
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




