<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");

    if(!empty($_SESSION['sopranos'])) {
    $SopranosOrders = new Sopranos\Orders($_SESSION['sopranos'], $pdo);

    // printr($SopranosOrders->setPizzaData());

    /*$SopranosOrders->insertCustomerData();
    $SopranosOrders->insertOrderData();  
    printr($SopranosOrders->getCoupon());
    printr($SopranosOrders->getCustomer());
    printr($SopranosOrders->getOrder());

    printr('-------------------------------------');

    printr($SopranosOrders->getOrderId());
    printr($SopranosOrders->getCustomerId());*/
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Cart · Sopranos Pizzaria</title>
<meta charset="UTF-8">
<meta name="author" content="Junyi Xie">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo date("YmdHis") ?>" media="screen">
</head>
<body>



<div id="app" class="transparent main">
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>        
            <li><a href="cart.php">Cart</a></li>         
        </ul>
    </nav>
</header>

<div class="content">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In voluptates dolores minima laborum eaque eveniet consequuntur officiis saepe autem, magni sequi sapiente nemo reprehenderit, harum aliquam error? Nisi, maiores quisquam.</p>
</div>

<footer>
    <p>Copyright &copy; <?php echo date("Y")?> Sopranos Pizzaria. All Rights Reserved.</p>
</footer>
</div>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>

</body>
</html>