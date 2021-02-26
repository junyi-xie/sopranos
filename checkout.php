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

<div class="site__content_container">

    
<h2>Checkout</h2>

<form action="checkout.php" method="post">

<legend>Contact info</legend>
    <input type="email" name="email" placeholder="Email address"><br/>
    <!-- <div>* Your Name must include a First and Last Name</div> -->


    <legend>Shipping info</legend>
    <input type="text" name="first_name" placeholder="First name"><br/>

    <input type="text" name="last_name" placeholder="Last name"><br/>
        
    <input type="text" name="adres" placeholder="Street address"><br/>

    
    
    <input type="text" name="city" placeholder="City"><br/>

    <input type="text" name="province" placeholder="Province"><br/>


    <input type="text" name="zipcode" placeholder="Postal code"><br/>
    
    <input type="text" name="country" placeholder="country"><br/>
    
    
    <input type="tel" name="phone" placeholder="Phone number"><br/>

    <input type="submit" value="Place your order">

</form>



</div>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>
</body>
</html>