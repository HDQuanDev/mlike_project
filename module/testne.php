<?php
$mail = $_GET["mail"];
$hi = file_get_contents('https://disify.com/api/email/' . $mail);
$str = json_decode($hi);
var_dump($str);
var_dump($hi);
var_dump($mail);