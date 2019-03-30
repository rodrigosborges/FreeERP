$(document).ready(function() {

    $(".integer").mask("#")
    $(".double").mask("#")
    $('.money').mask('000.000,00', {reverse: true});

    jQuery.validator.setDefaults({
        errorPlacement: function (error, element) {
            if(element.parents('form').hasClass('form-inline'))
            error.attr('hidden','hidden');
            element.parents('.form-group').append(error);
        },
    
        highlight: function(element, errorClass, validClass){
            var icon  = '<div class="input-group-append check-icon"><span class="input-group-text"><i class="fa fa-exclamation validate-icon" aria-hidden="true" style="color:#f44336"></i></span></div>';
            $(element).addClass(errorClass)
            $(element).parents('.form-group').find('label.error').remove();
        },
    
        success: function(label){
            label.parents('.form-group').find('.input-group').find('.check-icon').remove();
            label.parents('.form-group').find('label.error').remove();
        },
    
        onfocusout: function(element) {
            this.element(element);
        },
    });


})