    /* Copyright (c) - 2021 by Junyi Xie */	

    $(document).ready(function(){

        $("#coupon_code_link").click(function() {
            $(this).addClass("hidden");
            $('.js-coupon-code-wrapper').removeClass("hidden");
        });


        $("#coupon_code_apply").click(function() {

            var coupon_message = $('.js-coupon-code-message');
            var coupon_value = $('.js-coupon-code');
            var coupon_apply = $('.js-coupon-apply');
            var coupon_apply_secondary = $('.js-coupon-applying');

            coupon_apply.addClass('hidden');
            coupon_apply_secondary.removeClass('hidden');
            coupon_value.prop('disabled', true);

            setTimeout(function() {
                $.ajax({
                    url:"inc/ajax.php",
                    type: "post",
                    data: {
                        action: 'apply_coupon',
                        code: coupon_value.val(),
                    },
                    success: function(result){
                        console.log(result);
                        switch (result) {
                            case 'null':
                                coupon_message.removeClass('success').addClass('failure').html('Not a valid coupon code.');    
                            break;
                            default:
                                coupon_message.removeClass('failure').addClass('success').html('Coupon code applied.');
                            break;
                        }
                    },
                });

                coupon_apply_secondary.addClass('hidden');
                coupon_apply.removeClass('hidden');
                coupon_value.prop('disabled', false);

            }, 1500);
        });
        
        
        $(".form__textfield").blur(function() {

            var input = $(this);
            var email = $('.js-checkout-email');
            var email_error = $('.js-form-error--checkout-email');

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
                                    email.removeClass('error--inline');
                                    email_error.addClass('hidden');
                                break;
                                case 'false':
                                    email.addClass('error--inline');
                                    email_error.removeClass('hidden');
                                break;
                            }
                        },
                    });
                break;
                case 'order_form_phone':    
                case 'order_form_first_name':
                case 'order_form_last_name': 
                case 'order_form_address': 
                case 'order_form_city':
                case 'order_form_province':
                case 'order_form_zip':
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