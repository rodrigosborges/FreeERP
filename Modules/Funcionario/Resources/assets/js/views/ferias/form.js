$(document).ready(function(){
    
    let saldo = $('#saldo_periodo').val();
    console.log(saldo)

    $('#form').validate({
        rules: {
            "dias_ferias": {
                min: 0,
                max: saldo,
                number: true
            }
        },
        messages:{}
    })
})



