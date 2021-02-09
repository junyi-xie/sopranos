<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home · Sophranos Pizza</title>
    <meta charset="UTF-8">
    <meta name="author" content="Junyi Xie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <?php 
        $css = getAssetsFiles('assets\css', 'css');
        foreach($css as $file) {
            echo '<link rel="stylesheet" type="text/css" href="'.$file.'" media="screen">';
        } 
    ?>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>        
            </ul>
        </nav>
    </header>

    <footer>
        <p>Copyright &copy; <?php echo date("Y")?> Sopranos Pizzaria. All Rights Reserved.</p>
    </footer>



    <?php 
        $js = getAssetsFiles('assets\js', 'js');
        foreach($js as $file) {
            echo '<script type="text/javascript" src="'.$file.'"></script>';
        } 
    ?>

</body>
</html>