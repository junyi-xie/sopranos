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

                $contents = array_merge($contents, getFiles($entry, $ext));

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

                case 'php':
                    $s .= 'include_once("'.$file.'")';
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

        if(!isset($_SESSION['sopranos'][$key])) {

            $_SESSION['sopranos'][$key] = $value;
    
        } 

        return $_SESSION['sopranos'][$key];
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
     * @return mixed
     */
    function validateCouponCode($coupons = array(), $code) {

        foreach($coupons as $coupon) {

            if($coupon['code'] === strtoupper($code) || $coupon['code'] === strtolower($code)) {

                return $coupon['id'];

            }
        }
        
        return NULL;
    }


    /**
     * Put the customer order in a $_SESSION with the help of saveInSession() function.
     *
     * @param array $order
     *
     * @return boolean
     */
    function saveCustomerOrder($order = array()) {

        if (!is_array($order)) return false;
                
            saveOrderSession($order);

        return true;
    }



    /**
     * Save the customer order in $_SESSION.
     *
     * @param array $array
     *
     * @return array
     */
    function saveOrderSession($array = array()) {

        $_SESSION['sopranos']['order'][] = $array;

        return $_SESSION['sopranos']['order'];
    }


    /**
     * Search if array exists, if exists increment. [OLD]
     *
     * @param array $array
     *
     * @return array
     */
    function orderArrayExists($array = array()) {

        foreach($array as $key => $val) {

            if(isset($_SESSION['sopranos']['order'][$key])) {
                $key++;

                saveCustomerOrder($val, $key);
            }
        }

        return $array;
    }


    /**
     * Save the customer information like name, adres, email, etc in a $_SESSION for later use.
     *
     * @param array $information
     *
     * @return boolean
     */
    function saveCustomerData($data = array()) {

        $bEmail = isEmailValid($data['email']);

            if (!$bEmail) return false; 
            if(!is_array($data)) return false;

        saveInSession('customer', $data);

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
    function unsetVariable($variable, $name) {

        unset($variable[$name]);

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


    /**
     * Truncate the desired table, used just to clear data instead of manually deleting records inside the database.
     *
     * @param string $table
     * @param mixed|null $pdo
     * 
     * @return boolean
     */
    function truncateTable($table = '', $pdo = null) {

        if(empty($pdo)) {
            global $pdo;
        }

            if(!is_string($table)) return false;

        $sSql = 'TRUNCATE TABLE `'.$table.'`';
        $aSql = $pdo->query($sSql);

        if(!$aSql) return false;

        return true;
    }


    /**
     * Truncate the desired table, used just to clear data instead of manually deleting records inside the database.
     *
     * @param int|null $id
     * @param mixed|null $pdo
     * 
     * @return array
     */
    function selectBranches($id = null, $pdo = null) {

        if(empty($pdo)) {
            global $pdo;
        }

        $sSql = "SELECT * FROM branches WHERE 1 AND status = 1";

        if (!is_null($id) && $id > 0) {
            $sSql .= " AND id = $id LIMIT 1";
        }

        return $pdo->query($sSql)->fetch(PDO::FETCH_ASSOC);
    }

    
    if(!isset($_SESSION['sopranos']['number'])) { saveInSession('number', generateUniqueId()); }

    $aTypePizzas = selectAllById('pizzas_type');
    $aSizePizzas = selectAllById('pizzas_size');
    $aToppingPizzas = selectAllById('pizzas_topping');

    $aBrancheSopranos = selectBranches(1);
?>