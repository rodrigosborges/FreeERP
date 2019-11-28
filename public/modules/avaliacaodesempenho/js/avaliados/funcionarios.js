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
    var all = $(obj).children().children('.star')

    if (all.length > 0) {
        modify = all[0]
        
        $(modify).removeClass('star')
        $(modify).addClass('modified')
        $(modify).html('star')

    } else {
        var all = $(obj).children().children('.modified')

        Object.keys(all).map((key) => {
            if (!isNaN(key)) {
                $(all[key]).removeClass('modified')
                $(all[key]).addClass('star')
                $(all[key]).html('star_border')
            }
        })
    }

    var input = $(obj).siblings('.input')

    if ($(obj).children().children('.modified').length) {
        input.val($(obj).children().children('.modified').length)
    } else {
        input.val('')
    }
}

