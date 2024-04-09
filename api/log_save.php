<?php

ob_start();
session_start();
$r = $_GET['redirect'];
if(isset($_SESSION['u']) && isset($_SESSION['p'])) {
    $u = $_SESSION['u'];
    $p = $_SESSION['p'];
    setcookie("user", $u, time() + 31556926, "/");
    setcookie("pass", $p, time() + 31556926, "/");
    unset($_SESSION['p']);
    if($r !== '') {
        $re = $r;
    } else {
        $re = '/index.php';
    }
    header('location:'.$re);
} else {
    header('location:/');
}
