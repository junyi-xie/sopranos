<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    if(session_status() == PHP_SESSION_NONE )
    {
        session_start();
    }

    $hostname 	= "localhost";
    $username	= "root";
    $password 	= "";
    $dbname		= "sophranospizza";

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8mb4;", $username, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        
    } catch(PDOException $e) {

        die("Connection failed: ". $e->getMessage());        
    }

?>