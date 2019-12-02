$(document).ready(function() {

    $('.avaliar').on('click', function(e) {
        e.preventDefault()

        var id = $(this).attr('id')
        var nome = $(this).parent().siblings('.nome').text()

        $('.questoes').removeClass('invisible')

        $('#funcionarioId').val(id)    
        $('.funcionario-nome').html('Funcionario: '+nome)    
    })
})

var currentTab = 0; 
showTab(currentTab); 
    
function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    
    if (n == 0) {
        document.getElementById("prevBtn").disabled = true;
    } else {
        document.getElementById("prevBtn").disabled = false;
    }

    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").disabled = true;
        $('#submit-btn').removeClass('invisible')
    } else {
        document.getElementById("nextBtn").disabled = false;
        $('#submit-btn').addClass('invisible')
    }
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    
    x[currentTab].style.display = "none";
    
    currentTab = currentTab + n;
    
    if (currentTab >= x.length) {
        
    document.getElementById("regForm").submit();
        return false;
    }
    
    showTab(currentTab);
}

function control(obj) {

    var all = $(obj).parent().children()

    Object.keys(all).map((key) => {
        if (!isNaN(key)) {
            
            if ($(all[key]).attr('id') <= $(obj).attr('id')) {

                $(all[key]).children().removeClass('star')
                $(all[key]).children().addClass('modified')
                $(all[key]).children().html('star')

            } else {
                
                $(all[key]).children().removeClass('modified')
                $(all[key]).children().addClass('star')
                $(all[key]).children().html('star_border')
            }
        }
    })

    var input = $(obj).parent().parent().siblings('.input')

    input.val($(obj).parent().children().children('.modified').length)
}
