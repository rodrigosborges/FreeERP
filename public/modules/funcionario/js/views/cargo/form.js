$(document).ready(function(){
    $(".sendForm").on('click',function(){
        if($("#form").valid()){
            $(".sendForm").prop("disabled",true) 
            $("#form").submit()  
            console.log('success')
        }
    })
    $('#form').validate({
		rules: {
            
		},
		messages:{}
    })
})