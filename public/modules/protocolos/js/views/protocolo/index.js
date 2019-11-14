function setLoading(target) {
    var loading = $('<h3></h3>').attr({'class': 'text-center'})
    var img = '<div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div>'
    img.appendTo(loading)
    target.html(loading)
}

search = (url, target) => {
    setLoading(target)
    $.ajax({
        type: "GET",
        url: url,
        data: $("#form").serialize(),
        success: function (data) {
            target.html(data)
        },
        error: function (jqXHR, exception) {
            $("#results").html("<div class='alert alert-danger'>Desculpe, ocorreu um erro. <br> Recarregue a página e tente novamente</div>")
        },
    })
}

ativosInativos = (url) => {
    search(`${url}/ativos`, $("#ativos"))
    search(`${url}/inativos`, $("#inativos"))

    $("#ativos").on('click', 'ul.pagination a', function(e){
        e.preventDefault()
        search($(this).attr('href'), $("#ativos"))
    })

    $("#inativos").on('click', 'ul.pagination a', function(e){
        e.preventDefault()
        search($(this).attr('href'), $("#inativos"))
    })
}


$(document).on("click", "#search-button", function() {
    ativosInativos(`${main_url}/protocolos/protocolos/list`)
})


$(document).ready(function(){
    ativosInativos(`${main_url}/protocolos/protocolos/list`)
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            e.preventDefault()
            ativosInativos(`${main_url}/protocolos/protocolos/list`)
        }
    });
})