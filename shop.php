<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");

    

    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    

    $page = (isset($_GET['page']) ? $_GET['page'] : 'shop');



    $html = '';


    if($page == 'shop') {
        
        
        if(isset($_POST) && !empty($_POST)) {


            $date = date('Y-m-d H:i:s');
            $valid = selectValidCoupons($date);
            $coupon_id = validateCouponCode($valid, $_POST['coupon_code']);

            $data = array();
            $data = $_POST;

            $coupon = $coupon_id;

            saveInSession('coupon', $coupon);

            unset($data['coupon_code']);

            saveCustomerOrder($data);

            header("location: http://localhost:8080/sopranos/shop.php?page=form");
            exit();
        }


        printr($_SESSION);
        $html .= '

        <form action="shop.php" method="post">';

    

    $html .= '<br/><br/><h2>CHOOSE TYPE</h2><br/>';
    foreach ($aTypePizzas as $type) {
        $html .= '<label for="type-'.$type['id'].'">'.$type['name'].'</label>';
        $html .= '<input type="radio" name="type_id" id="type-'.$type['id'].'" value="'.$type['id'].'">';
        $html .= '<span>&euro;'.number_format($type['price'], 2).'</span><br/>';
    }
    
    $html .= '<br/><br/><h2>CHOOSE SIZE</h2><br/>';
    foreach ($aSizePizzas as $size) {
        $html .= '<label for="type-'.$size['id'].'">'.$size['name'].'</label>';
        $html .= '<input type="radio" name="size_id" id="size-'.$size['id'].'" value="'.$size['id'].'">';
        $html .= '<span>+ &euro;'.number_format($size['price'], 2).'</span><br/>';
    }
    
    $html .= '<br/><br/><h2>CHOOSE TOPPINGS</h2><br/>';
    foreach ($aToppingPizzas as $topping) {
        $html .= '<label for="type-'.$topping['id'].'">'.$topping['name'].'</label>';
        $html .= '<input type="checkbox" name="topping_id['.$topping['id'].']" id="topping-'.$topping['id'].'" value="'.$topping['name'].'">';
        $html .= '<span>+ &euro;'.number_format($topping['price'], 2).'</span><br/>';
    }

    $html .= '

    <br/><br/>
    <input type="text" name="coupon_code" placeholder="coupon code?"><br/>
    <input type="number" name="quantity" placeholder="how many?"><br/><br/>
    <input type="submit" value="next">
    </form><br/><br/><br/><br/><br/><br/>';



    } else if ($page == 'form') {


        if(isset($_POST) && !empty($_POST)) {



            $t = saveCustomerData($_POST);

            if(!$t) {
                $html .= 'use a valid email';
            }

            header("location: http://localhost:8080/sopranos/cart.php");
            exit();
        }

        printr($_SESSION);

        

        $html .= '<form action="shop.php?page=form" method="post">
        
        <input type="text" name="first_name" placeholder="first_name"><br/>
        <input type="text" name="last_name" placeholder="last_name"><br/>
        <input type="email" name="email" placeholder="email"><br/>
        <input type="tel" name="phone" placeholder="phone"><br/>
        <input type="text" name="adres" placeholder="adres"><br/>
        <input type="text" name="zipcode" placeholder="zipcode"><br/>
        <input type="text" name="country" placeholder="country"><br/>
        <input type="text" name="city" placeholder="city"><br/>
        <input type="submit" value="next">
        
        </form>';


    } else {
        header("location: http://localhost:8080/sopranos/shop.php");
        exit();
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop · Sopranos Pizzaria</title>
    <meta charset="UTF-8">
    <meta name="author" content="Junyi Xie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo date("YmdHis") ?>" media="screen">
</head>
<body>

<?php echo $html ?>

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