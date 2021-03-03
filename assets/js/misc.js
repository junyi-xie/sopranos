    /* Copyright (c) - 2021 by Junyi Xie */	

    $(document).ready(function(){
        
        $(".form__textfield").blur(function() {

            var boolen = false;
            var output = false;


            switch ($(this).attr('id')) {
                case 'order_form_email':
                    $.ajax({
                        url:"inc/ajax.php",
                        type: "post",
                        data: {
                            action: 'validate_email',
                            email: $(this).val(),
                        },
                        success: function(result){
                            console.log(result);
                            if(result == 'true') {
                                 boolen = true;
                            }
                        },
                    });
                break;
                case ('order_form_phone' || 'order_form_first_name' || 'order_form_last_name' || 'order_form_address' || 'order_form_city' || 'order_form_province' || 'order_form_province' || 'order_form_country'):

                    if( !$(this).val() && boolen ){
                        $(this).addClass('error--inline');
                        $(this).next().removeClass('hidden');
                    }  else {
                        $(this).removeClass('error--inline');
                        $(this).next().addClass('hidden');
                    }
                break;
            }

        });


        $("#coupon_code_link").click(function(){

            $(this).addClass("hidden");
            $('.js-coupon-code-wrapper').removeClass("hidden");
        });

    });