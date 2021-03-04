    /* Copyright (c) - 2021 by Junyi Xie */	

    $(document).ready(function(){

        $("#coupon_code_link").click(function(){
            $(this).addClass("hidden");
            $('.js-coupon-code-wrapper').removeClass("hidden");
        });
        
        
        $(".form__textfield").blur(function() {

            var input = $(this);

            switch (input.attr('id')) {
                case 'order_form_email':
                    $.ajax({
                        url:"inc/ajax.php",
                        type: "post",
                        data: {
                            action: 'validate_email',
                            email: input.val(),
                        },
                        success: function(result){
                            switch (result) {
                                case 'true':
                                    $('.js-checkout-email').removeClass('error--inline');
                                    $('.js-form-error--checkout-email').addClass('hidden');
                                break;
                                case 'false':
                                    $('.js-checkout-email').addClass('error--inline');
                                    $('.js-form-error--checkout-email').removeClass('hidden');
                                break;
                            }
                        },
                    });
                break;
                case 'order_form_coupon_code':
                    $.ajax({
                        url:"inc/ajax.php",
                        type: "post",
                        data: {
                            action: 'apply_coupon',
                            code: input.val(),
                        },
                        success: function(result){
                            console.log(result);
                        },
                    });
                break;
                case 'order_form_phone':    
                case 'order_form_first_name':
                case 'order_form_last_name': 
                case 'order_form_address': 
                case 'order_form_city':
                case 'order_form_province': 
                case 'order_form_province':
                case 'order_form_country':
                    if(!input.val()){
                        input.addClass('error--inline');
                        input.next().removeClass('hidden');
                    }  else {
                        input.removeClass('error--inline');
                        input.next().addClass('hidden');
                    }
                break;
            }
        });
    });