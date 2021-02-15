<?php
    /* Copyright (c) - 2021 by Junyi Xie */


    /**
     * print_r but fancier.
     *
     * @param mixed $arr
     *
     * @return string
     */
    function printr($arr) {
        print '<code><pre style="text-align: left; margin: 10px;">'.print_r($arr, TRUE).'</pre></code>';
    }


    /**
     * Get files in given directory with specified extention type.
     *
     * @param string $dir
     * @param string $ext
     *
     * @return array
     */
    function getFiles($dir = 'assets\js', $ext = 'js') {

        $handle = opendir($dir);

        if (!$handle) return array();
        
        $contents = array();

        while ($entry = readdir($handle))   
        {
            if ($entry == '.' || $entry == '..') continue;

            $entry = $dir.DIRECTORY_SEPARATOR.$entry;
            
            if (is_file($entry)) {

                if (preg_match("/\.$ext$/", $entry)) {

                    $contents[] = $entry;

                }

            } else if (is_dir($entry)) {

                $contents = array_merge($contents, getFiles($entry));

            }
        }

        closedir($handle);
    
        return $contents;
    }

    
    /**
     * Load files from array. This fuction is used with getFiles().
     *
     * @param array $contents
     *
     * @return string
     */
    function loadFiles($contents = array()) {

        $s = '';

        foreach($contents as $file) {

            $ext = pathinfo($file, PATHINFO_EXTENSION);

            switch ($ext) {

                default:
                    $s .= 'silence...';
                break;

                case 'js':
                    $s .= '<script type="text/javascript" src="'.$file.'"></script>';
                break;

                case 'css': 
                    $s .= '<link rel="stylesheet" type="text/css" href="'.$file.'?'.date("YmdHis").'" media="screen">';
                break;

            }

        }

        return $s;
    }


    /**
     * Generate uniqueid for order number.
     *
     * @return int
     */
    function generateUniqueId() {

        return hexdec(uniqid());
    }


    /**
     * Set key for session with desired value.
     *
     * @param mixed $key
     * @param mixed $value
     * 
     * @return array
     */
    function saveInSession($key, $value) {

        if(!isset($_SESSION[$key])) {

            $_SESSION[$key] = $value;
    
        } 

        return $_SESSION[$key];
    }


    /**
     * Retreive the desired session with given name.
     *
     * @param mixed $name
     * 
     * @return boolean|array
     */
    function getInSession($name) {

        if (isset($_SESSION[$name])) return $_SESSION[$name];

        return false;
    }


    /**
     * Validate emailadres.
     *
     * @param mixed $email
     * 
     * @return boolean
     */
    function isEmailValid($email){ 

        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+./', $email);
    }


    /**
     * Get all the coupons that have not expired and are valid to use.
     *
     * @param mixed $datetime
     * @param object|null $pdo
     * 
     * @return mixed
     */
    function selectValidCoupons($datetime, $pdo = null) {

        if(empty($pdo)) {
            global $pdo;
        }

        $coupons = $pdo->query("SELECT * FROM coupons WHERE 1 AND valid <= '".$datetime."' AND expire >= '".$datetime."' AND quantity > 0 ORDER BY id DESC");

        return $coupons->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Validate the input code by the customer and see if they match with the codes from database.
     *
     * @param array $coupons
     * @param mixed $code
     * 
     * @return boolean
     */
    function validateCouponCode($coupons = array(), $code) {

        foreach($coupons as $coupon) {

            if($coupon['code'] === strtoupper($code) || $coupon['code'] === strtolower($code)) {

                return true;
                
            }
        }
        
        return false;
    }


    /**
     * Put the customer order in a $_SESSION with the help of saveInSession() function.
     *
     * @param array $order
     *
     * @return boolean
     */
    function saveCustomerOrder($order = array()) {

        saveInSession('customer_order', $order);

        return true;
    }


    /**
     * Save the customer information like name, adres, email, etc in a $_SESSION for later use.
     *
     * @param array $information
     *
     * @return boolean
     */
    function saveCustomerInformation($information = array()) {

        $bEmail = isEmailValid($information['email']);

            if (!$bEmail) return false; 

        saveInSession('customer_information', $information);

        return true;
    }

    /**
     * Get all the customer details attached to the given uniqueid.
     * 
     * @param int @uniqueid
     *
     * @return array
     */
    function getCustomer($uniqueid) {

        return $_SESSION[$uniqueid];
    }


    /**
     * Unset variable with given name.
     * 
     * @param mixed $name
     *
     * @return boolean
     */
    function unsetSession($name) {

        unset($_SESSION[$name]);

        return true;
    }


    /**
     * Destroy all data that was attached to sessions.
     *
     * @return boolean
     */
    function clearSession() {

        return session_destroy();
    }


    /**
     * Select query to get rows from given table, could also retreive rows with given id.
     *
     * @param string $table
     * @param int|null $id
     * @param mixed|null $pdo
     * 
     * @return mixed
     */
    function selectAllById($table = '', $id = null, $pdo = null) {

        if(empty($pdo)) {
            global $pdo;
        }

            if(!is_string($table)) return false;

        $sql = "SELECT * FROM $table";    

        if (!is_null($id)) {
            $sql .= " WHERE id = $id";
        }

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


    if(!isset($_SESSION['order_number'])) { saveInSession('order_number', generateUniqueId()); }

    $aTypePizzas = selectAllById('pizzas_type');
    $aSizePizzas = selectAllById('pizzas_size');
    $aToppingPizzas = selectAllById('pizzas_topping');

?>