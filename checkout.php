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

                                    <input class="form__textfield form__textfield--full" type="email" name="email" placeholder="Email address">

                                    <input class="form__textfield form__textfield--full" type="tel" name="phone" placeholder="Phone number">

                                </div>

                            </fieldset>

                            <fieldset>

                                <div class="form__group">

                                    <legend class="checkout__legend">Shipping info</legend>

                                    <div class="checkout_form__row">

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full" type="text" name="first_name" placeholder="First name">

                                        </div>

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full" type="text" name="last_name" placeholder="Last name">

                                        </div>

                                    </div>
                                        
                                    <input class="form__textfield form__textfield--full" type="text" name="address" placeholder="Street address">

                                    <input class="form__textfield form__textfield--full" type="text" name="address_2" placeholder="Apt / Suite / Other (optional)">

                                    <div class="checkout_form__row">

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full" type="text" name="city" placeholder="City">

                                        </div>

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full" type="text" name="province" placeholder="Province">

                                        </div>
                                    
                                    </div>
                                    
                                    <div class="checkout_form__row">

                                        <div class="checkout__input--half">

                                            <input class="form__textfield form__textfield--full" type="text" name="zipcode" placeholder="Postal code">

                                        </div>

                                        <div class="checkout__input--half">

                                            <select class="form__textfield form__textfield--full" type="text" name="country" placeholder="Country">

                                                <?= getListCountry(); ?>

                                            </select>

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
                        
                            <!-- order summary info -->

                        </div>
                    
                        <div class="order_summary__help">
                        
                            <!-- coupon etc -->

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