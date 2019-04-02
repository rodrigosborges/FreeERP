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
            "horas_semanais": {
                min: 1,
                max: 56,
                number: true,
            },
            "salario":{
                regex: /\d{1,3}(?:\.\d{3})*?,\d{2}/,
            }
        },
		messages:{}
    })
})