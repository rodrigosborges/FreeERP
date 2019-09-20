var ids = []

$('#pesquisa').keyup(function(){
    var query = $(this).val();

    if(query != ''){

        $.ajax({
            url: main_url+'/protocolos/busca',
            method: "POST",
            data: {query:query},
            dataType: 'json',
            success:function(data){
                
                $('#pesquisa').autocomplete({
                    source: data,
                  
                    select: function (e, i) {
                        
                        console.log(i)
                        if (ids.indexOf(i.item.value) === -1) {
                            ids.push(i.item.value);
                            $("#arrayInteressados").val(ids)
                            console.log(ids)
                            $("#interessados").append('<div class="interessado"><i class="material-icons trash">delete</i><span data-id="'+i.item.value+'" class="del">'+i.item.label+'</span></div>')
                        } else if (ids.indexOf(i.item.value) > -1) {
                            console.log(i.item.value + ' nome já selecionado.');
                        }

                        $("#pesquisa").val('')
                        return false
   
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



