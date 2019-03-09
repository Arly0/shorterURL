<?php

$url = $_POST['full_url'];

$shortURL = randomURL();
echo $shortURL;

function randomURL(){
    $symb       = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $len        = rand(5,8);
    $symbLen    = strlen($symb);
    $symbol_arr = str_split($symb);
    $string     = '';

    for($i=0;$i<$len;$i++)
    {
        $register = rand(0,1);

        function ($symbol_arr, $symbLen, $register){
            if ($register)
                return $obj = $symbol_arr[strtoupper(rand(1,$symbLen))]; // случаное генерирование короткого url
            else
                return $obj = $symbol_arr[strtolower(rand(1,$symbLen))]; // случаное генерирование короткого url
        };
        $string .= $obj;
    }
    return $string;
}