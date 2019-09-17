$('#form').validate({
    rules: {
       "data":{
            date: true,
            maxlength: 10
       },
       "numero":{
            digits: true,
            maxlength:50
       },
       "produtos[][produto_id]":{
            digits: true
        },
        "produtos[][quantidade]":{
            digits: true,
            maxlength: 3
        }
    },

    messages: {}
})

