//FUNÇÃO PARA CLONAR UM ELEMENTO
function clonar(target, local, indices) {
    var clone = $(target).last().clone()
    clone.find(".errors").remove()
    clone.hide().fadeIn("slow").appendTo(local)

    if(indices) {
        $(target).last().find('input, select').each(function(i, input) {
            var index = $(this).attr('name').split('[')[1].split(']')[0]
            $(this).attr('name', $(this).attr('name').replace(index, parseInt(index) + 1))
            if($(input).hasClass("custom-file-input")){
                $(this).parent().find(".custom-file-label").html("Selecione");
                $(this).closest(".input-group").find(".file_download").remove()
            }
        })
    }
}

//FUNÇÃO PARA REMOVER UM ELEMENTO
function remover(target, buttonClicked) {
    $(buttonClicked).closest(target).remove()
}

$(".sendForm").on('click',function(){
    if($("#form").valid()){
        $(".sendForm").prop("disabled",true) 
        $("#form").submit()  
    }
})