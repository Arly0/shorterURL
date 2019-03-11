<?php
include_once ("DBconnection.php"); // функция подключает файл ЕДИНОЖДЫ
$url = $_POST['full_url'];
checkDir($url,$link);
$domen = parse_url($url); // ф-ия разбивает урл на протокол, домен, директорию и тд
$domen = $domen['host']; // получаем домен

WrongDomain:    // чтобы можно было сгенерировать короткий урл сначала, если такой существует

$shortURL = randomURL(); // генерация урла

$newurl = "$domen/$shortURL";   // конкатенация домена и урла

$res = checkURL($newurl,$link);     // проверяет на наличие новоиспеченного адреса в БД
if (!$res){
    goto WrongDomain;   // если результат был ложным - вернет к 8 строке и проведет генерацию по новой
}

saveURL($newurl,$url,$link);    // сэйв урла в БД

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

function checkDir($dir,$conn){ // проверка на наличие дириктории в БД
    $querySelect = "SELECT * FROM `URL_path` WHERE `directory` = '$dir'";
    $queryTake   = "SELECT `url` FROM `URL_path` WHERE `directory` = '$dir'"; // выводит короткий урл в соотв с дир

    $result = mysqli_query($conn,$querySelect);
    if(mysqli_num_rows($result) != 0){
        echo "Такая директория уже имеет сокрощенный URL. Вот она:"; //добавить вывод короткого урла через переменную кверитэйк
        exit(); // убивает скрипт
    }
    else{
        return 1; // продолжает работу
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

    try {mysqli_query($conn,$querySave);}

    catch(Exception $e){
        echo mysqli_connect_errno();
        echo ("\n" . $e -> getMessage());
        exit();
    }
}