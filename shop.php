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


            // $date = date('Y-m-d H:i:s');
            // $valid = selectValidCoupons($date);
            // $coupon_id = validateCouponCode($valid, $_POST['coupon_code']);

            $data = array();
            $data = $_POST;

            // printr($data);
            // $coupon = $coupon_id;

            // saveInSession('coupon', $coupon);

            // unset($data['coupon_code']);
            // unset($data['btnSubmit']);
            // unset($data['btnDelete']);

            saveCustomerOrder($_POST);

            // printr($_SESSION);

            // exit();
            header("location: http://localhost:8080/sopranos/checkout.php");                
            exit();
            
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
</head>
<body>

<?php include_once("inc/header.php") ?>

<div class="site__content_container">

    <div class="site__main">

        <div class="site__wrapper">

            <div class="site__shop_product_container">

                <div class="image_stack__container___wrapper">
                
                    <div class="image_stack__container">
                    
                        <div class="image_stack__inner">

                            <div class="image_stack__images">
                            
                                <div class="image_stack__image_wrap image_stack__image_wrap--active">
                                
                                    <img class="image_stack__image" src="">

                                </div>

                            </div>
                        
                            <nav class="image_stack__nav">
                            
                                <ul class="image_stack__nav_list">
                                
                                    <li class="image_stack__nav_item image_stack__nav_item--active">
                                    
                                        <img class="image_stack__nav_item_thumb" src="">

                                    </li>

                                </ul>

                            </nav>

                        </div>

                    </div>

                </div>

                <div class="shop__column--product">

                    <div class="shop__purchase_container">

                        <form class="shop_form_container" id="shop_form" action="shop.php" accept-charset="UTF-8" method="post">
                        
                            <div class="product_dropdown__container">

                                <div class="product__type_label">

                                    <h2 class="product_dropdown__label">Available Products:</h2>

                                </div>

                                <div class="product__type_dropdown_container">

                                    <select class="product__type_dropdown" name="type_id" id="shop_type_dropdown">

                                        <?php foreach($aTypePizzas as $key => $aType): ?>

                                            <option class="js-product_option" value="<?= $aType['id']; ?>"><?= $aType['name']; ?> - <?= number_format((float)$aType['price'], 2, '.', ''); ?> EUR</option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                            </div>

                            <div class="product__container">

                                <nav class="product__nav">

                                    <ul class="product__list">

                                        <?php $aSqlTypeImages = $pdo->query("SELECT pt.*, i.* FROM pizzas_type AS pt LEFT JOIN images AS i ON i.id = pt.image_id WHERE 1 AND pt.quantity > 0")->fetchAll(PDO::FETCH_ASSOC);?>

                                        <?php foreach($aSqlTypeImages as $key => $aTypeImages): ?>
                                        
                                            <!-- product__single--active -->
                                        <li class="product__single js-product-thumbnails">

                                            <div class="product__img-wrap">

                                                <img class="product__thumb" src="assets/images/layout/<?= $aTypeImages['link']; ?>">

                                            </div>

                                        </li>

                                        <?php endforeach; ?>

                                    </ul>

                                </nav>

                            </div>

                            <div class="product_description__container">

                                <!-- blah blah blah -->

                            </div>

                            <div class="shop_page__size_quantity_container">

                                <div class="product__size_container">

                                    <div class="product__size_label">

                                        <h2 class="product_dropdown__label">Select Size:</h2>

                                    </div>

                                    <div class="product__size_selector_menu_container">

                                        <select class="product__size_selector_menu" name="size_id" id="shop_size_selector">

                                            <?php foreach($aSizePizzas as $key => $aSize): ?>

                                            <option value="<?= $aSize['id']; ?>"> <?= $aSize['size']; ?> </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="product__quantity_container">

                                    <div class="product__quantity_label">

                                        <h2 class="product_dropdown__label">Quantity:</h2>

                                    </div>

                                    <div class="product__quantity_input_field_container">
                                
                                        <input class="product__quantity_input_field" type="number" name="quantity" min="1" max="999" value="1" id="shop_quantity_input">
                                    
                                    </div>

                                </div>

                            </div>

                            <div class="product__toppings_container">

                                <div class="product__toppings_label">

                                    <h2 class="product_dropdown__label">Toppings:</h2>

                                </div>
                                
                                <div class="product__topping_list_container">

                                    <ul class="product__topping_list">

                                        <?php foreach($aToppingPizzas as $key => $aTopping): ?>

                                            <li class="product__topping_list_item product__topping_list_item--active">

                                                <input class="product__topping_checkbox--type" type="checkbox" name="topping_id[<?= $aTopping['id']; ?>]" value="<?= $aTopping['name']; ?>">

                                            </li>

                                        <?php endforeach; ?>

                                    </ul>

                                </div>

                            </div>

                            <div class="shop_transaction">

                                <button class="shop_button--transaction shop_form__submit" type="submit" value="Add to Cart">Add to Cart</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- TO DO, CREATE MODAL     -->

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>

</body>
</html>