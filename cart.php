<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping     Cart · Sopranos Pizzabar</title>
    <meta charset="UTF-8">
    <meta name="author" content="Junyi Xie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo date("YmdHis") ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css" media="screen">
</head>
<body>

<?php include_once("inc/header.php") ?>

<?php if (empty($_SESSION['sopranos']['order'])): ?>
            
<div class="shopping_cart__container">

    <div class="shopping_cart--empty">
    
        <div class="empty_shopping_cart_container">
        
            <div class="empty_shopping_cart--center empty_shopping_cart--image"></div>

            <div class="empty_shopping_cart--center">

                <h1>Your cart is empty.</h1>
            
            </div>

        </div>

    </div>

</div>

<?php else: ?>

<div class="site__content_container">

    <div class="site__wrapper">

        <div class="site__main">

            <div class="shopping_cart__container">

                <div class="shopping_cart__wrapper">

                    <!-- left -->
                    <div class="shopping_cart_items__container">
                    
                        <h2 class="shopping_cart__title">Shopping Cart</h2>
                    
                        <div class="shopping_cart_order__wrapper">
                        
                        <?php foreach($_SESSION['sopranos']['order'] as $iKey => $aOrderItem):?>

                            <div class="shopping_cart_item" id="shopping_cart_item-<?= $iKey; ?>">
                            
                            
                            </div>

                        <?php endforeach; ?>
                        
                        </div>

                    </div>


                    <!-- right -->
                    <div class="shopping_cart_summary__container">

                        <div class="shopping_cart_summary">
                        
                            <div class="shopping_cart_summary__detail shopping_cart_summary__detail--subtotal">
                            
                                <div class="detail__label">

                                    <span class="checkout_item_label">Cart Subtotal</span>

                                    <span class="checkout_item_count">(1 item)</span>

                                </div>

                                <div class="detail__value">

                                    <span class="checkout_item_price">€15.33</span>

                                </div>

                            </div>

                            <div class="shopping_cart_summary__message">
                                Subtotal includes VAT. Shipping will be calculated on checkout
                            </div>
                        
                            <div class="shopping_cart_summary__button">
                            
                                <a class="button--transaction shopping_cart_summary__submit" href="checkout.php">Proceed to Checkout</a>
                            
                            </div>

                        </div>
                
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php endif; ?>

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>

</body>
</html>