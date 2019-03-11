<?php
include_once ("DBconnection.php");
// проверка на наличие короткого URL и получение пути
$url = $_POST['url'];

$querySelect = $pdoConnect->prepare("SELECT * FROM `URL_path` WHERE `url` = :url");
$querySelect->bindValue(':url', $url, PDO::PARAM_STR);

if($querySelect->execute())
{
    echo "URL занят.<br>";
}