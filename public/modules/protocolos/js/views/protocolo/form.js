var nomes = []

$('#pesquisa').keyup(function(){
    var query = $(this).val();

    if(query != ''){

        $.ajax({
            url: main_url+'/protocolos/busca',
            method: "POST",
            data: {query:query},
            dataType: 'json',
            success:function(data){
                // var dataNomes = []

                // for(i=0;i < data.length; i++){
                //     dataNomes.push(data[i].nome)
                // }
                $('#pesquisa').autocomplete({
                    source: data,
                    select: function (e, i) {
                        console.log(i)
                        if (nomes.indexOf(i.item.value) === -1) {
                            nomes.push(i.item.value);
                            console.log(nomes)
                            $("#interessados").append('<div class="interessado"><i class="material-icons trash">delete</i><span data-id="'+i.item.value+'" class="del">'+i.item.label+'</span></div>')
                        } else if (nomes.indexOf(i.item.value) > -1) {
                            console.log(i.item.value + ' nome já selecionado.');
                        }
                    }
                })
            }
            
        })

    }

})

$(document).on("click", ".trash", function() {

    let id = $(this).parent().find('span').data('id')

    console.log(id)

    $(this).parent().remove()
    console.log(nomes);
})



