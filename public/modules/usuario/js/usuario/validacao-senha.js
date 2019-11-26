    $("#password").on('keyup', function() {

        if($(this).val().length >= 8 && $(this).val().length <= 16) {
            $("#length-check").find('i').css('color', 'SpringGreen')
            $("#length-check").find('p').css('text-decoration', 'line-through')
        } else {
            $("#length-check").find('i').css('color', 'black')
            $("#length-check").find('p').css('text-decoration', 'none')
        }

        // alert($(this).val().match(/\W/)!=null)

        if($(this).val().match(/[0-9]\d/)>=1) {
            $("#num-check").find('i').css('color', 'SpringGreen')
            $("#num-check").find('p').css('text-decoration', 'line-through')
        } else {
            $("#num-check").find('i').css('color', 'black')
            $("#num-check").find('p').css('text-decoration', 'none')
         }

        if($(this).val().match(/[a-z]/)!=null) {
            $("#lower-check").find('i').css('color', 'SpringGreen')
            $("#lower-check").find('p').css('text-decoration', 'line-through')
        } else {
            $("#lower-check").find('i').css('color', 'black')
            $("#lower-check").find('p').css('text-decoration', 'none')
        }

        if($(this).val().match(/[A-Z]/)!=null) {
            $("#upper-check").find('i').css('color', 'SpringGreen')
            $("#upper-check").find('p').css('text-decoration', 'line-through')
        } else {
            $("#upper-check").find('i').css('color', 'black')
            $("#upper-check").find('p').css('text-decoration', 'none')
        }
        
        if($(this).val().match(/\W/)!=null) {
            $("#special-check").find('i').css('color', 'SpringGreen')
            $("#special-check").find('p').css('text-decoration', 'line-through')
        } else {
            $("#special-check").find('i').css('color', 'black')
            $("#special-check").find('p').css('text-decoration', 'none')
        }
        


    });