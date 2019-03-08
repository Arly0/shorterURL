<?php

$host   = 'localhost';
$nameDB = 'users';
$user   = 'root';
$pass   = '';

$link = mysqli_connect($host, $user, $pass, $nameDB);

if(!$link) {
    echo ("connection error: " . mysqli_connect_errno());
    exit();
}
?>