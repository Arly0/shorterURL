<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        urlShorter
    </title>
    <meta charset="utf-8">
    <style>

    </style>
</head>
<body>
<!--form for check full url-->
<h1>URL check</h1>
<form action="URLcheck.php" method="post">
    <input name="url" type="text" placeholder="Enter URL" value="" required>
    <input type="submit" value="CHECK">
</form>
<!--form for convert url in short url-->
<h1>Make URL shorter</h1>
<p>Необходимо вводить полную директоию, с протоколами. Например: https://google.com/home/pages</p>
<form action="shortURL.php" method="post">
    <input type="text" placeholder="Enter URL" value="" required name="full_url">
    <br><br><input type="checkbox" name="direct"> <p>Нажать если нужно сократить все внутрилежащие директории(in progress) </p>
    <input type="submit" value="Make shorter">
</form>
</body>
</html>
