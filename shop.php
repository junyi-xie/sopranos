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

            // $coupon = $coupon_id;

            // saveInSession('coupon', $coupon);

            unset($data['coupon_code']);
            unset($data['btnSubmit']);
            unset($data['btnDelete']);

            saveCustomerOrder($data);

            if (isset($_POST['btnDelete'])) {
                header("location: http://localhost:8080/sopranos/checkout.php");
                
            } else {
                header("location: http://localhost:8080/sopranos/shop.php");
                exit();
            }
            
        }


        // printr($_SESSION);
        $html .= '

        <form action="shop.php" method="post">';


        $html .= '<br/><br/><h2>CHOOSE TYPE</h2><br/>';
        foreach ($aTypePizzas as $type) {
            $html .= '<label for="type-'.$type['id'].'">'.$type['name'].'</label>';
            $html .= '<input type="radio" name="type_id" id="type-'.$type['id'].'" value="'.$type['id'].'">';
            $html .= '<span>&euro;'.number_format($type['price'], 2).'</span><br/>';
        }
        
        $html .= '<br/><br/><h2>CHOOSE SIZE</h2><br/>

        <select name="size_id" id="size">';
        foreach ($aSizePizzas as $size) {
            $html .= '<option  id="size-'.$size['id'].'" value="'.$size['id'].'">'.$size['name'].'</option>';
            $html .= '<span>+ &euro;'.number_format($size['price'], 2).'</span><br/>';
        }
        $html .='</select></br></br>';
        
        $html .= '<br/><br/><h2>CHOOSE TOPPINGS</h2><br/>';
        foreach ($aToppingPizzas as $topping) {
            $html .= '<label for="type-'.$topping['id'].'">'.$topping['name'].'</label>';
            $html .= '<input type="checkbox" name="topping_id['.$topping['id'].']" id="topping-'.$topping['id'].'" value="'.$topping['name'].'">';
            $html .= '<span>+ &euro;'.number_format($topping['price'], 2).'</span><br/>';
        }

        $html .= '

        <br/><br/>
        <input type="text" name="coupon_code" placeholder="coupon code?"><br/>
        <input type="number" name="quantity" placeholder="how many?" min="1"><br/><br/>
        <input type="submit" name="btnSubmit" value="more">
        <input type="submit" name="btnDelete" value="checkout">
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
        <input type="submit" value="checkout">
        
        </form>';


    } else {
        header("location: http://localhost:8080/sopranos/shop.php");
        exit();
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop · Sopranos Pizzabar</title>
    <meta charset="UTF-8">
    <meta name="author" content="Junyi Xie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo date("YmdHis") ?>" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome.css" media="screen">
</head>
<body>

<!-- <?php echo $html ?> -->

<?php include_once("inc/header.php") ?>

<div class="main">

    <h2>Shopping Cart</h2>

    <form action="shop.php" method="post">


            <br/><br/><h2>CHOOSE TYPE</h2><br/>

            <select name="type_id" id="type">
            <?php foreach($aTypePizzas as $key=> $type): ?>
                <option id="size-<?=$type['id'];?>" value="<?=$type['id'];?>"><?=$type['name'];?></option>
                <span>&euro;<?= number_format($type['price'], 2)?></span><br/>
            <?php endforeach; ?>
            </select>

            <br/><br/><h2>CHOOSE SIZE</h2><br/>

            <select name="size_id" id="size">
            <?php foreach($aSizePizzas as $key=> $size): ?>
                <option id="size-<?=$size['id'];?>" value="<?=$size['id'];?>"><?=$size['name'];?></option>
                <span>+ &euro;<?=number_format($size['price'], 2);?></span><br/>
            <?php endforeach; ?>
            
            </select></br></br>

            <br/><br/><h2>CHOOSE TOPPINGS</h2><br/>
            <?php foreach($aToppingPizzas as $key=>$topping): ?>
                <label for="type-<?= $topping['id']; ?>"><?= $topping['name']; ?></label>
                <input type="checkbox" name="topping_id[<?= $topping['id']; ?>]" id="topping-<?=$topping['id'];?>" value="<?=$topping['name'];?>">
                <span>+ &euro;<?= number_format($topping['price'], 2) ?> </span><br/>
            <?php endforeach; ?>

            <br/><br/>
            <!-- <input type="text" name="coupon_code" placeholder="coupon code?"><br/> -->
            <input type="number" name="quantity" placeholder="how many?" min="1" value="1"><br/><br/>
            <input type="submit" name="btnSubmit" value="more">
            <input type="submit" name="btnDelete" value="Add to cart">

            
    </form>

</div>

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>

</body>
</html>