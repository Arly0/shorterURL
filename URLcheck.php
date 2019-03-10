<?php
include_once ("DBconnection.php");
// проверка на наличие короткого URL и получение пути
$url = $_POST['url'];

$querySelect = "SELECT * FROM `URL_path` WHERE `url` = '$url'";

// запрос в бд
$result = mysqli_query($link, $querySelect);

//если строк с результатом не равны 0 , т е больше, то выводит директорию к этому урлу
if(mysqli_num_rows($result) != 0)
{
    echo "URL занят. ВОт его директория:<br>";
    $row = mysqli_fetch_assoc($result);
    echo $row['directory'];
}