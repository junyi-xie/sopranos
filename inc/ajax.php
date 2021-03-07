<?php
    /* Copyright (c) - 2021 by Junyi Xie */

    include_once("../inc/connect.php");
    include_once('../inc/functions.php');

    if(isset($_POST['action']) && !empty($_POST['action'])) {

        $date = date("YmdHis");
        $action = $_POST['action'];

        switch($action) {
            case 'validate_email': 
                $bEmail = isEmailValid($_POST['email']);
                echo json_encode($bEmail);
            break;
            case 'apply_coupon':
                $aValidCoupons = selectValidCoupons($date);
                $iCoupon = validateCouponCode($aValidCoupons, $_POST['code']);
                echo json_encode($iCoupon);
            break;
            case 'get_coupon':
                $aCouponData = selectAllById('coupons', $_POST['coupon_id']);
                echo json_encode($aCouponData);
            break;
            case 'update_order_item':

                // echo json_encode();
            break;
            case 'remove_order_item':

                // echo json_encode();
            break;
        }
    }    
?>