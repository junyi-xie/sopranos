<?php
    /* Copyright (c) - 2021 by Junyi Xie */

    include_once("../inc/connect.php");
    include_once('../inc/functions.php');

    if(isset($_POST['action']) && !empty($_POST['action'])) {

        $action = $_POST['action'];

        switch($action) {
            case 'validate_email': 
                $bEmail = isEmailValid($_POST['email']);
                echo json_encode($bEmail);
            break;
        }
    }    
?>