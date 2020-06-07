<?php
    $server = $config->database["server"];
    $user = $config->database["user"];
    $pwd = $config->database["pwd"];
    $db = $config->database["db"];

    try{
        $con = new PDO('mysql:host='.$server.';dbname='.$db.';charset=utf8', $user,$pwd);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        echo $e->getMessage();
    }