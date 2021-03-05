<?php
    /* Copyright (c) - 2021 by Junyi Xie */

    include_once("../inc/connect.php");
    include_once('../inc/functions.php');

    if(isset($_POST['action']) && !empty($_POST['action'])) {

        $date = date("Y-m-d H:i:s");
        $action = $_POST['action'];

        switch($action) {
            case 'validate_email': 
                $bEmail = isEmailValid($_POST['email']);
                echo json_encode($bEmail);
            break;
            case 'apply_coupon':
                $aValidCoupons = selectValidCoupons($date);
                $iCoupon = validateCouponCode($aValidCoupons, $_POST['code']);

                // !is_null($iCoupon) ? createCheckoutOrderList($_SESSION['sopranos']['order'], $iCoupon) : 0; 

                echo json_encode($iCoupon);
            break;
            case '':
                
            break;
        }
    }    
?>