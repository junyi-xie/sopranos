<?php

class Orders 
{
    private $ordernumber;

    function set_name($name) {
        $this->ordernumber = $name;
    }

    function get_name() {
        return $this->ordernumber;
    }

}

?>