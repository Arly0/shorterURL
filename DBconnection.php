<?php

$name = 'users';
$host = 'localhost';
$pass = '';
$user = 'root';
try {
    $pdoConnect = new PDO("mysql:dname=$name;host=$host, $user, $pass");
}
catch (Exception $ex){
    echo "Connection error: " . $ex->getMessage();
    exit();
}

?>