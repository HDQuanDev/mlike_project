<?php

$admin = '1';
require_once('../_System/db.php');
switch ($_GET['act']) {
    case 'insert':
        $fp = @fopen('acctdshihiq.txt', "r");
        $yourvar = fread($fp, filesize('acctdshihiq.txt'));
        $a = 0;
        $arr = explode(PHP_EOL, $yourvar);
        $total = count($arr);
        foreach($arr as $key => $value) {
            $user = explode("|", $value)[0];
            $pass = explode("|", $value)[1];
            $tien = explode("|", $value)[2];
            $proxy = explode("|", $value)[3];
            $proxyauth = explode("|", $value)[4];
            $ac = mysqli_query($db, "SELECT * FROM `acctds` WHERE `user` = '$user'");
            $cacc = mysqli_num_rows($ac);
            if($cacc == 0) {
                if($tien > 7600) {
                    $a++;
                    mysqli_query($db, "INSERT INTO `acctds` SET `user` = '$user',`pass` = '$pass', `slsd` = '0', `tien`='$tien', `proxy`='$proxy', `proxyauth`='$proxyauth'");
                }
            }
        }
        $d = $total - $a;
        echo 'Đã add '.$a.' acc vào csdl, '.$d.' acc không được add';

        break;

    case 'check':
        $res = mysqli_query($db, 'SELECT sum(tien) FROM acctds');
        $row = mysqli_fetch_row($res);
        $sum = $row[0];
        echo 'Tổng số xu là: ' .$sum.' xu';
        break;

    case 'export':
        $result1 = mysqli_query($db, "SELECT * FROM `acctds`");
        while($ro = mysqli_fetch_assoc($result1)) {
            echo ''.$ro['user'].'|'.$ro['pass'].'|'.$ro['tien'].'<br>';
        }
        break;

    case 'delete':
        mysqli_query($db, "DELETE FROM acctds");
        echo 'đã xoá tất cả acc';
        break;
}
