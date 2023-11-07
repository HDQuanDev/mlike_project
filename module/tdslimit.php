<?php
$hdq = 'ok';
require_once(__DIR__ . '/../_System/db.php');

function get_limit($act, $tongxu = "0", $userr = "0")
{
    global $db;
    $ac = mysqli_query($db, "SELECT * FROM `acctds` WHERE `slsd` < '11' AND `tien` > '7600' ORDER BY RAND() LIMIT 1");
    $cacc = mysqli_num_rows($ac);
    if ($cacc > 0) {
        $acc = mysqli_fetch_assoc($ac);
        $user = $acc['user'];
        $pass = $acc['pass'];
        $tien = trim($acc['tien']);
        $proxy = $acc['proxy'];
        $proxyauth = $acc['proxyauth'];
        if ($act == 'user') {
            $result = $user;
        } elseif ($act == 'pass') {
            $result = $pass;
        } elseif ($act == 'proxy') {
            $result = $proxy;
        } elseif ($act == 'proxypass') {
            $result = $proxyauth;
        }elseif($act == 'updatexu'){
            $xu = $tongxu;
            mysqli_query($db, "UPDATE `acctds` SET `tien` = `tien`-'$xu', `slsd` = `slsd`+'1' WHERE `user` = '$userr'");
            $result = 'ok';
        }

        return $result;
    } else {
        return 'error';
    }
}
