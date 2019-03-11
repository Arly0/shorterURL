<?php
include_once ("DBconnection.php"); // функция подключает файл ЕДИНОЖДЫ
$url = $_POST['full_url'];
checkDir($url,$pdoConnect);
$domen = parse_url($url); // ф-ия разбивает урл на протокол, домен, директорию и тд
$domen = $domen['host']; // получаем домен

WrongDomain:    // чтобы можно было сгенерировать короткий урл сначала, если такой существует

$shortURL = randomURL(); // генерация урла

$newurl = "$domen/$shortURL";   // конкатенация домена и урла

$res = checkURL($newurl,$pdoConnect);     // проверяет на наличие новоиспеченного адреса в БД
if (!$res){
    goto WrongDomain;   // если результат был ложным - вернет к 8 строке и проведет генерацию по новой
}

saveURL($newurl,$url,$pdoConnect);    // сэйв урла в БД

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

function checkDir($dir,$pdoConnect){ // проверка на наличие дириктории в БД
    $queryTake = $pdoConnect->prepare("SELECT `url` FROM `URL_path` WHERE `directory` = :directory"); // выводит короткий урл в соотв с дир
    $queryTake->bindValue(':directory' , $dir, PDO::PARAM_STR);

    if($queryTake->execute()){
        echo "Такая директория уже имеет сокрощенный URL. Вот она:"; //добавить вывод короткого урла через переменную кверитэйк
        exit(); // убивает скрипт
    }
    else{
        return 1; // продолжает работу
    }
}

function checkURL($url,$pdoConnect){
    $querySelect = $pdoConnect->prepare("SELECT * FROM `URL_path` WHERE `url` = :url");
    $querySelect->bindValue(':url', $url, PDO::PARAM_STR);

    if($querySelect->execute() )
    {
        return false;
    }
    else{
        return true;
    }
}

function saveURL($url,$dir,$conn){
    $querySave = $conn->prepare('INSERT INTO `URL_path` (`url`, `directory`) VALUES (:$url, :$dir)');
    $querySave->bindValue(':url', $url, PDO::PARAM_STR);
    $querySave->bindValue(':dir', $dir, PDO::PARAM_STR);

    try {
        $querySave->execute();
    }

    catch(Exception $e){
        echo 'Cant add in DB' . $e->getMessage();
        exit();
    }
}