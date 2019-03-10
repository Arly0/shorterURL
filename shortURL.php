<?php

$url = $_POST['full_url'];
$domen = parse_url($url);
$domen = $domen['host'];

$shortURL = randomURL();

$newurl = "$domen/$shortURL";

echo "<a href='#'>$newurl</a>";



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