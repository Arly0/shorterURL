<?php
include_once ("DBconnection.php");
$url = $_POST['full_url'];
checkDir($url,$link);
$domen = parse_url($url);
$domen = $domen['host'];

WrongDomain:

$shortURL = randomURL();

$newurl = "$domen/$shortURL";

$res = checkURL($newurl,$link);
if (!$res){
    goto WrongDomain;
}

saveURL($newurl,$url,$link);

echo "УРЛ успешно добавлен: <a href='#'>$newurl</a>";



function randomURL(){
    $symb       = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $len        = rand(5,8);
    $symbLen    = strlen($symb);
    $symbol_arr = str_split($symb);
    $string     = '';

    for($i=0;$i<$len;$i++)
    {
             $string .= $symbol_arr[rand(1,$symbLen)];
    }
    return $string;
}

function checkDir($dir,$conn){
    $querySelect = "SELECT * FROM `URL_path` WHERE `directory` = '$dir'";
    $queryTake   = "SELECT `url` FROM `URL_path` WHERE `directory` = '$dir'"; // выводит короткий урл в соотв с дир

    $result = mysqli_query($conn,$querySelect);
    if(mysqli_num_rows($result) != 0){
        echo "Такая директория уже имеет сокрощенный URL. Вот она:"; //добавить вывод короткого урла через переменную кверитэйк
        exit();
    }
    else{
        return 1;
    }
}

function checkURL($url,$conn){
    $querySelect = "SELECT * FROM `URL_path` WHERE `url` = '$url'";

    $result = mysqli_query($conn, $querySelect);
    if(mysqli_num_rows($result) !=0 )
    {
        return false;
    }
    else{
        return true;
    }
}

function saveURL($url,$dir,$conn){
    $querySave = "INSERT INTO `URL_path` (`url`, `directory`) VALUES ('$url', '$dir')";

    $result = mysqli_query($conn,$querySave);
    if($result)
    {
        return 1;
    }
    else{
        echo mysqli_connect_errno();
        exit();
    }
}