<?php
$mail = $_GET["mail"];
$str = json_decode(file_get_contents("https://disify.com/api/email/".$mail);
var_dump($str);