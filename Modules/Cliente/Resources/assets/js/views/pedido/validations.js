$('#form').validate({
    rules: {
       "data":{
            date: true,
            maxlength: 10,
        
       },
       "numero":{
            digits: true,
       },
       "desconto":{
            digits: true,
       },
       "produtos[produto_id]":{
            digits: true,
        },
        "produtos[quantidade]":{
            digits: true,
        },
        "produtos[desconto]":{

        },
        


    },

    messages: {}
})
