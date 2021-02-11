<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home · Sopranos Pizzaria</title>
    <meta charset="UTF-8">
    <meta name="author" content="Junyi Xie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo date("YmdHis") ?>" media="screen">
</head>
<body>

<div id="app" class="transparent main">
    <header>
        <img src="assets/images/layout/sopranos-logo.png">
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

<?php print('<!--'.date("YmdHis").'-->'); $js = getFiles(); if(!empty($js)){ foreach($js as $file) { echo '<script type="text/javascript" src="'.$file.'"></script>'; } }?>
</body>
</html>