<?php
    /* Copyright (c) - 2021 by Junyi Xie */

    function printr($arr) {
        print '<code><pre style="text-align:left; margin:10px;">'.print_r($arr, TRUE).'</pre></code>';
    }


    function getJavascriptFiles($dir = 'assets\js', $ext = 'js') {

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

                $contents = array_merge($contents, getJavascriptFiles($entry));

            }
        }

        closedir($handle);
    
        return $contents;
    }

?>