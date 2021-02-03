<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");

    
    $page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

    switch ($page) {
        case 'home':
        default:
            $stmt = $pdo->query("SELECT * FROM coupons ORDER BY id DESC LIMIT 1");
            $user = $stmt->fetch();
        break;
        case 'about':
            $test = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur atque aliquam non. Aliquam ducimus possimus quia laborum provident earum aperiam, dolorem officia, doloremque repellendus quidem commodi, exercitationem laudantium non suscipit.';
        break;
    }

    include($page . '.php');
?>