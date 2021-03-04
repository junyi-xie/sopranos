<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout · Sopranos Pizzabar</title>
    <meta charset="UTF-8">
    <meta name="author" content="Junyi Xie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo date("YmdHis") ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css" media="screen">
</head>
<body>

<?php include_once("inc/header.php") ?>

<div class="site__content_container">

    <div class="site__main">

        <div class="site__wrapper">

            <div class="form__message form__message--error">
                <!-- error message -->
            </div>

            <div class="checkout__wrapper">
            
                <form class="order_form" id="order_form" action="checkout.php" accept-charset="UTF-8" method="post">

                    <div class="checkout__container">
                    
                        <div class="checkout_form">

                            <div class="checkout_form__header">
                        
                                <h2 class="checkout_form__title">Checkout</h2>

                            </div>

                            <fieldset>
                    
                                <div class="form__group">
                                    
                                    <legend class="checkout__legend">Contact info</legend>

                                    <input class="form__textfield form__textfield--full js-checkout-email" type="email" name="customer[email]" placeholder="Email address" id="order_form_email">

                                    <div class="form__error js-form-error--checkout-email hidden">* Enter a valid email address</div>

                                    <input class="form__textfield form__textfield--full js-checkout-phone" type="tel" name="customer[phone]" placeholder="Phone number" id="order_form_phone">

                                    <div class="form__error js-form-error--checkout-phone hidden">* Enter a valid phone number</div>

                                </div>

                            </fieldset>

                            <fieldset>

                                <div class="form__group">

                                    <legend class="checkout__legend">Shipping info</legend>

                                    <div class="checkout_form__row">

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full js-shipping-first-name" type="text" name="customer[first_name]" placeholder="First name" id="order_form_first_name">

                                            <div class="form__error js-form-error--first-name hidden">* Enter your first name</div>

                                        </div>

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full js-shipping-last-name" type="text" name="customer[last_name]" placeholder="Last name" id="order_form_last_name">

                                            <div class="form__error js-form-error--last-name hidden">* Enter your last name</div>

                                        </div>

                                    </div>
                                        
                                    <input class="form__textfield form__textfield--full js-shipping-address" type="text" name="customer[address]" placeholder="Street address" id="order_form_address">

                                    <div class="form__error js-form-error--shipping-address hidden">* Enter a valid address</div>

                                    <input class="form__textfield form__textfield--full" type="text" name="customer[address_2]" placeholder="Apt / Suite / Other (optional)" id="order_form_address_2">

                                    <div class="checkout_form__row">

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full js-shipping-city" type="text" name="customer[city]" placeholder="City" id="order_form_city">

                                            <div class="form__error js-form-error--shipping-city hidden">* Enter a valid city</div>
                                        
                                        </div>

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full js-shipping-province" type="text" name="customer[province]" placeholder="Province" id="order_form_province">

                                            <div class="form__error js-form-error--shipping-province hidden">* Enter a valid province</div>

                                        </div>
                                    
                                    </div>
                                    
                                    <div class="checkout_form__row">

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full js-shipping-zipcode" type="text" name="customer[zipcode]" placeholder="Postal code" id="order_form_zip">
                                            
                                            <div class="form__error js-form-error--shipping-zip hidden">* Enter a valid zip code</div>

                                        </div>

                                        <div class="checkout__input--half">

                                            <select class="form__textfield form__textfield--full js-shipping-country" type="text" name="customer[country]" placeholder="Country" id="order_form_country">

                                                <?= getListCountry(); ?>

                                            </select>

                                            <div class="form__error js-form-error--shipping-country hidden">* Select a valid country</div>

                                        </div>
                                    
                                    </div>

                                </div>

                            </fieldset>            

                            <div class="checkout_form__footer">
                            
                                <button class="button--transaction checkout_form_footer__submit" type="submit" value="Place your order">Place your order</button>

                            </div>

                        </div>

                    </div>

                    <div class="order_summary__container">
                    
                        <div class="order_summary__info">

                            <div class="checkout__summary_heading">

                                <h4 class="checkout__summary_title">
                                    
                                    <span class="checkout__summary__title">Order summary</span>

                                    <a class="order_summary__modify_order" href="cart.php" title="Modify order">Modify order</a>

                                </h4>

                            </div>

                            <div class="checkout__separator--page"></div>

                            <div class="orders_summary__wrapper">
                            
                                <?php if(!empty($_SESSION['sopranos']['order'])){ echo createCheckoutOrderList($_SESSION['sopranos']['order']); } ?>

                            </div>

                        </div>
                    
                        <div class="order_summary__help">
                        
                            <div class="coupon_code_link__container"><button type="button" class="coupon_code_link js-coupon-button" id="coupon_code_link">I have a coupon code</button></div>

                            <div class="coupon_code__wrapper js-coupon-code-wrapper hidden" id="coupon_code_box">
                                
                                <legend class="checkout__legend">Coupon Code</legend>
                                
                                <div class="coupon_code__container">
                                    
                                    <input class="form__textfield form__textfield--full" placeholder="Enter your code here" type="text" name="coupon_code" id="order_form_coupon_code">
                                    
                                    <button type="button" class="button--apply" id="coupon_code_apply">Apply</button>

                                    <button type="button" class="button--apply disabled hidden" id="promo_code_applying">Applying…</button>

                                </div>
                                
                                <div class="coupon_code_message js-coupon-code-message">
                                    
                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>
</body>
</html>