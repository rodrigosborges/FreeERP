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

$(document).on("click", "#search-button", function() {
    search(`${main_url}/funcionario/logs/list`, $("#logs"))
})

$(document).on('click', '#logs ul.pagination a', function(e){
    e.preventDefault()
    search($(this).attr('href'), $("#logs"))
})

$(document).ready(function(){
    search(`${main_url}/funcionario/logs/list`, $("#logs"))

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            e.preventDefault()
            search(`${main_url}/funcionario/logs/list`, $("#logs"))
        }
    });
})