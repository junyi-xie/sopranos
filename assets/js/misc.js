    /* Copyright (c) - 2021 by Junyi Xie */	

    $(document).ready(function(){


        $(".form__textfield").blur(function() {

            input = $(this);

            if(input === $("#order_form_email, #order_form_phone, #order_form_first_name, #order_form_last_name, #order_form_address, #order_form_city, #order_form_province, #order_form_zip, #order_form_country") ) {

                if( !input.val() ) {

                    input.addClass('error--inline');
                    input.next().removeClass('hidden');

                }  else {
                    input.removeClass('error--inline');
                    input.next().addClass('hidden');
                }  
            }
        });

        $("#promo_code_link").click(function(){
            console.log('t');
            $(this).data('clicked', true);
        });

    });