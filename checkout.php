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
</head>
<body>

<?php include_once("inc/header.php") ?>

<div class="site__content_container">

    <div class="site__main">

        <div class="site__wrapper">

            <?php if (empty($_SESSION['sopranos'])): /* if (empty($_SESSION['sopranos']['order'])): */ ?>
                
            <div class="shopping_cart__container">
            
                <div class="shopping_cart--empty">
                
                    <div class="empty_shopping_cart_container">
                    
                        <div class="empty_shopping_cart--center empty_shopping_cart--image">

                            <!-- image -->

                        </div>

                        <div class="empty_shopping_cart--center">

                            <h1>Your cart is empty.</h1>
                        
                        </div>

                    </div>

                </div>

            </div>

            <?php else: ?>

            <div class="checkout__wrapper">
            
                <form action="checkout.php" method="post">

                    <div class="checkout__container">
                    
                        <div class="checkout_form">

                            <div class="checkout_form__header">
                        
                                <h2>Checkout</h2>

                            </div>

                            <fieldset>
                    
                                <legend>Contact info</legend>

                                <input type="email" name="email" placeholder="Email address"><br/>

                            </fieldset>

                            <fieldset>

                                <legend>Shipping info</legend>

                                <input type="text" name="first_name" placeholder="First name"><br/>

                                <input type="text" name="last_name" placeholder="Last name"><br/>
                                    
                                <input type="text" name="adres" placeholder="Street address"><br/>

                                <input type="text" name="city" placeholder="City"><br/>

                                <input type="text" name="province" placeholder="Province"><br/>

                                <input type="text" name="zipcode" placeholder="Postal code"><br/>

                                <input type="text" name="country" placeholder="country"><br/>

                                <input type="tel" name="phone" placeholder="Phone number"><br/>

                            </fieldset>            

                            <div class="checkout_form__footer">
                            
                                <button type="submit" value="Place your order">Place your order</button>

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

            <?php endif; ?>

        </div>

    </div>

</div>

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>
</body>
</html>