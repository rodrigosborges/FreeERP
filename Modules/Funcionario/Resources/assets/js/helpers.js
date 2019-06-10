//FUNÇÃO PARA CLONAR UM ELEMENTO
function clonar(target, local, indices) {
    $(target).last().clone().appendTo(local)

    if(indices) {
        $(target).last().find('input, select').each(function() {
            var index = $(this).attr('name').split('[')[1].split(']')[0]
            $(this).attr('name', $(this).attr('name').replace(index, parseInt(index) + 1))
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
        console.log('success')
    }
})