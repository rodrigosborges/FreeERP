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