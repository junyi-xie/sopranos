<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");

    $t = 1;

    if(!empty($_SESSION['sopranos']) && $t == 2 ) {
        $SopranosOrders = new Sopranos\Orders($_SESSION['sopranos'], $pdo);
    }
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
</head>
<body>

<?php include_once("inc/header.php") ?>

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>

</body>
</html>