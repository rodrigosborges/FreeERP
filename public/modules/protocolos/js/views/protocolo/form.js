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
                $('#pesquisa').autocomplete({
                    source: data,
                    select: function (e, i) {
                        if (nomes.indexOf(i.item.value) === -1) {
                            nomes.push(i.item.value);
                            $("#interessados").append('<div class="interessado"><i class="material-icons trash">delete</i><span class="del">'+i.item.value+'</span></div>')
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
    console.log(document.getElementsByClassName('del').innerHTML);
})



