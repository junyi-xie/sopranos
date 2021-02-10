<?php
    /* Copyright (c) - 2021 by Junyi Xie */


    /**
     * print_r but fancier
     *
     * @param mixed $arr
     *
     * @return string
     */
    function printr($arr) {
        print '<code><pre style="text-align: left; margin: 10px;">'.print_r($arr, TRUE).'</pre></code>';
    }


    /**
     * Get files in given directory with specified extention type
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
     * Load files from array. This fuction is used with getFiles()
     *
     * @param array $array
     *
     * @return string
     */
    function loadFiles($array = array()) {

        $s = '';

        foreach($array as $file) {

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
     * @return int|float
     */
    function generateUniqueId() {

        return hexdec(uniqid());
    }


    /**
     * Set key for session with desired value
     *
     * @param mixed $key
     * @param mixed $value
     * 
     * @return mixed
     */
    function saveInSession($key, $value) {

        if(!isset($_SESSION[$key])) {

            $_SESSION[$key] = $value;

        }

        return $_SESSION[$key];
    }

    saveInSession('ORDERNUMBER', generateUniqueId());


    function menu() {

    }

?>