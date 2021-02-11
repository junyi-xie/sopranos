<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");

    printr($_SESSION['orders']['order_number']);

    if(empty($_SESSION['order_number'])) { 
        $ordernumber = saveInSession('order_number', generateUniqueId(), 'orders'); 
    } 
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(isset($_POST) && !empty($_POST)) {
        printr($_POST);
    }

    $page = (isset($_GET['page']) ? $_GET['page'] : 'shop');



    $html = '';


    if($page == 'shop') {
        
        $type = $pdo->query("SELECT * FROM pizzas_type");
        $size = $pdo->query("SELECT * FROM pizzas_size");
        $topping = $pdo->query("SELECT * FROM pizzas_topping");


        if(!empty($_POST['code'])) {
            $date = date('Y-m-d H:i:s');
            $valid = selectValidCoupons($date);
            $validate = validateCouponCode($valid, $_POST['code']);
            $bCoupon = saveInSession('COUPON_APPLIED', $validate, 'COUPON');
        }

        printr($_SESSION);
        



        $pizzatype = $type->fetchAll(PDO::FETCH_ASSOC);
        $pizzasize = $size->fetchAll(PDO::FETCH_ASSOC);
        $pizzatopping = $topping->fetchAll(PDO::FETCH_ASSOC);
        
        

        
        // printr($result1);
        // printr($result2);
        // printr($result3);


        $html .= '

        <form action="shop.php" method="post">
    <input type="hidden" name="url" value="'.$url .'">
    <input type="hidden" name="order_number" value="'.$_SESSION['ORDER_NUMBER'] .'">
    <input type="hidden" name="check_in" value="'.date("YmdHis").'">';

    

    $html .= '<br/><br/><h2>CHOOSE TYPE</h2><br/>';
    foreach ($pizzatype as $type) {
        $html .= '<label for="type-'.$type['id'].'">'.$type['name'].'</label>';
        $html .= '<input type="radio" name="type_id" id="type-'.$type['id'].'" value="'.$type['id'].'"><br/>';
    }
    
    $html .= '<br/><br/><h2>CHOOSE SIZE</h2><br/>';
    foreach ($pizzasize as $size) {
        $html .= '<label for="type-'.$size['id'].'">'.$size['name'].'</label>';
        $html .= '<input type="radio" name="size_id" id="size-'.$size['id'].'" value="'.$size['id'].'"><br/>';
    }
    
    $html .= '<br/><br/><h2>CHOOSE TOPPINGS</h2><br/>';
    foreach ($pizzatopping as $topping) {
        $html .= '<label for="type-'.$topping['id'].'">'.$topping['name'].'</label>';
        $html .= '<input type="checkbox" name="topping_id['.$topping['name'].']" id="topping-'.$topping['id'].'" value="'.$topping['id'].'"><br/>';
    }
    
   

    $html .= '

    <br/><br/>
    <input type="text" name="code" placeholder="coupon code?">
    <input type="number" name="quantity" placeholder="how many?">
    <input type="submit" value="next">



</form>


<br/><br/><br/><br/><br/><br/>';



    } else if ($page == 'form') {


        printr($_SESSION);


        $html .= '<form action="shop.php?page=form" method="post">
        
        <input type="text" name="name" placeholder="name">
        <input type="submit" value="next">
        
        
        
        
        
        
        
        
        </form>';








        

    } else if ($page == 'order') {

    } else if ($page == 'checkout') {

    } else if ($page == 'payment') {

    } else if ($page == 'confirm') {

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
                <li><a href="about.php">About</a></li>        
                <li><a href="menu.php">Menu</a></li>        
                <li><a href="shop.php">Shop</a></li>        
                <li><a href="contact.php">Contact</a></li>     
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

<?php print('<!--'.date("YmdHis").'-->'); $js = getFiles($dir = 'assets\js', $ext = 'js'); if(!empty($js)){ foreach($js as $file) { echo '<script type="text/javascript" src="'.$file.'"></script>'; } }?>


</body>
</html>