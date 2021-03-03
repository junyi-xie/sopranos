<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");

    if(!empty($_SESSION['sopranos'])) {
        // $SopranosOrders = new Sopranos\Orders($_SESSION['sopranos'], $pdo);
    }

    printr($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart · Sopranos Pizzabar</title>
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

    <!-- show item page -->

<?php endif; ?>

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>

</body>
</html>