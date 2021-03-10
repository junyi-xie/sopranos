    /* Copyright (c) - 2021 by Junyi Xie */	

    $(document).ready(function(){

        $(".js-edit_cart_item").click(function(event) {
            event.preventDefault();

            $(this).removeClass('hidden').addClass('hidden');
            $(this).next().addClass('hidden').removeClass('hidden');
            $(this).parent().parent().next().addClass('hidden').removeClass('hidden');
        });


        $(".js-cancel_cart_item").click(function(event) {
            event.preventDefault();

            $(this).removeClass('hidden').addClass('hidden');
            $(this).prev().addClass('hidden').removeClass('hidden');
            $(this).parent().parent().next().removeClass('hidden').addClass('hidden');
        });


        $(".js-remove_cart_item").click(function(event) {
            event.preventDefault();

            $.ajax({
                url:"inc/ajax.php",
                type: "post",
                data: {
                    action: 'remove_order_item',
                    key: $(this).attr('shopping-cart-item-id'),
                },
                success: function(result){
                    switch (result) {
                        case 'true':
                            location.reload(); 
                        break;
                    }
                },
            });
        });


        $(".js-update_cart_item").click(function(event) {
            event.preventDefault();

            var edit = $(this).parent().parent().next().children().last().children().last().children();
            var select = edit.first().children().last();
            var input = edit.last().children().last();

            $.ajax({
                url:"inc/ajax.php",
                type: "post",
                data: {
                    action: 'update_order_item',
                    quantity: input.val(),
                    size: select.val(),
                    key: $(this).attr('shopping-cart-item-id'),
                },
                success: function(result){
                    switch (result) {
                        case 'true':
                            location.reload(); 
                        break;
                    }
                },
            });
        });


        $('.js-shopping_cart_item__size--select').change(function(event){
            event.preventDefault();

            var button = $(this).parent().parent().parent().parent().parent().children().first().children().last();
            var option = $(this).find("option:selected").prop('defaultSelected');

            switch (option) {
                case true:
                    button.find('.js-cancel_cart_item').addClass('hidden').removeClass('hidden');
                    button.find('.js-update_cart_item').removeClass('hidden').addClass('hidden');
                break;
                case false:
                    button.find('.js-cancel_cart_item').removeClass('hidden').addClass('hidden');
                    button.find('.js-update_cart_item').addClass('hidden').removeClass('hidden');
                break;
            }
        });


        $('.js-shopping_cart_item__quantity--input').change(function(event){
            event.preventDefault();

            var button = $(this).parent().parent().parent().parent().parent().children().first().children().last();
            var value = $(this).prop('defaultValue');
            var input = $(this).val();

            switch (input) {
                case value:
                    button.find('.js-cancel_cart_item').addClass('hidden').removeClass('hidden');
                    button.find('.js-update_cart_item').removeClass('hidden').addClass('hidden');
                break;
                default:
                    button.find('.js-cancel_cart_item').removeClass('hidden').addClass('hidden');
                    button.find('.js-update_cart_item').addClass('hidden').removeClass('hidden');
                break;
            }
        });


        $("#coupon_code_link").click(function(event) {
            event.preventDefault();

            $(this).addClass("hidden");
            $('.js-coupon-code-wrapper').removeClass("hidden");
        });


        $("#coupon_code_apply").click(function(event) {
            event.preventDefault();

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
                        switch (result) {
                            case 'null':
                                $('.js-coupon-code-message').removeClass('success').addClass('failure').html('Not a valid coupon code.');    
                            break;
                            default:
                                $.ajax({
                                    type: "post",
                                    url: "inc/ajax.php",
                                    data: {
                                        action: 'get_coupon',
                                        coupon_id: result,
                                    },
                                    success: function (data) {

                                        var coupon_data = JSON.parse(data);
                                        var new_total_price = 0.00;

                                        switch (coupon_data.type) {
                                            case 1:           
                                            
                                                $('.js-order_summary__discount_wrapper').removeClass('hidden');
                                                $('.js-discount_tax_label').html('('+coupon_data.discount+'%)');
 
                                                $('.js-order_summary_section').each(function(index) {

                                                    if (!$('#order_summary_section-'+index).length) { index++; } 

                                                    var item_quantity = parseInt($('#order_summary__item_quantity-'+index).text().replace(/[^0-9\.]/g, ''));
                                                    var item_price = parseFloat($('#order_summary__item_price-'+index).text().replace(/[^0-9\.]/g, ''));
                                                    
                                                    var new_price = ((item_price * ((100 - coupon_data.discount) / 100)) * item_quantity);
                                                    var discount_price = ((item_price * item_quantity) - new_price);

                                                    new_total_price += new_price;

                                                    $('#order_summary__discount_money-'+index).html('-€'+discount_price.toFixed(2)+' EUR');
                                                    $('#order_summary__subtotal_price-'+index).html('€'+new_price.toFixed(2)+' EUR');
                                                });

                                                $('.js-order_summary__subtotal_price_without_discount').removeClass('hidden');
                                                $('.js-order_summary_total').html('€'+new_total_price.toFixed(2)+' EUR');
                                                $('.js-coupon-code-message').removeClass('failure').addClass('success').html('Coupon code applied.');

                                            break;
                                        }
                                    }
                                });
                            break;
                        }
                    },
                });

                coupon_apply_secondary.addClass('hidden');
                coupon_apply.removeClass('hidden');
                coupon_value.prop('disabled', false);

            }, 1500);
        });
        
        
        $(".form__textfield").blur(function(event) {
            event.preventDefault();

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