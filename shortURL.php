<?php

$url = $_POST['full_url'];

$shortURL = randomURL();
echo $shortURL;

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