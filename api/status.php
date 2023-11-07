<?php
$quan = [];
$page = "view_fb";
include("../_System/config.php");
$quan["service"]["viewfb"]["sv1"] = "$sv1";
$quan["service"]["viewfb"]["sv2"] = "$sv2";
$quan["service"]["viewfb"]["sv3"] = "$sv3";
$quan["service"]["viewfb"]["sv4"] = "$sv4";
$quan["service"]["viewfb"]["sv5"] = "$sv5";
$quan["service"]["viewfb"]["sv6"] = "$sv6";
$quan["service"]["viewfb"]["sv7"] = "$sv7";
$quan["service"]["viewfb"]["sv8"] = "$sv8";
$page = "like_fb";
include("../_System/config.php");
$quan["service"]["likefb"]["sv4"] = "$sv4";
echo json_encode($quan);