<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$hdq = 'ok';
require_once('../../_System/db.php');
$token = 'e30d9ade3f5b5f761f658b-c46b-f64c-40a8-2d21ff927a1b';
$url = 'https://api.web2m.com/historyapimomo/' . $token;
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$getdata = json_decode($result, true);
$getlist = $getdata["momoMsg"]["tranList"];
$countlist = count($getlist);
for ($i = 0; $i < $countlist; $i++) {
    $tranid = $getdata["momoMsg"]["tranList"][$i]["tranId"];
    $nd = $getdata["momoMsg"]["tranList"][$i]["comment"];
    $tien = $getdata["momoMsg"]["tranList"][$i]["amount"];
    $delnd = trim($nd);
    $xlnd = strtolower($delnd);
    $expnd = explode(" ", $xlnd);
    $cpnd = $expnd[0];
    $usernd = $expnd[1];
    $user = strtolower($usernd);
    if ($cpnd == 'mlike') {
        // Thực hiện cộng tiền cho khách
        $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$user' AND `site` = '$site'");
        $tko = mysqli_num_rows($tko);
        if ($tko !== 0) {
            $cgd = mysqli_query($db, "SELECT * FROM `momo` WHERE `tranid` = '$tranid' AND `site` = '$site'");
            $cgd = mysqli_num_rows($cgd);
            if ($cgd == 0) {
                $u = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$user' AND `site` = '$site'");
                $u = mysqli_fetch_assoc($u);
                $time = time();
                $dd = $u['vnd'];
                $nd1 = 'Nạp tiền vào tài khoản:';
                $gtls = '+';
                $bd = $tien;
                if ($tien > $s['minref']) {
                    if ($u['ref'] !== '0') {
                        $uref = $u['ref'];
                    } else {
                        $uref = 'dramasee';
                    }
                    if (isset($uref)) {
                        $ref = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$uref' AND `site` = '$site' LIMIT 1");
                        $ref = mysqli_fetch_assoc($ref);
                        $ckref = $s['ckref'];
                        $cref = $tien / 100 * $ckref;
                        $rbd = $ref['vnd'];
                        $nd = 'Nhận tiền từ hoa hồng giới thiệu:';
                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd',`bd` = '$cref',`user`='$uref',`time`='$time', `loai` = '2', `goc` = '$rbd', `idgd` = '$cref', `gt` = '+', `site` = '$site'");
                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$cref' WHERE `username` = '$uref' AND `site` = '$site'");
                        mysqli_query($db, "UPDATE `member` SET `vndgt` = `vndgt`+'$cref' WHERE `username` = '$user' AND `site` = '$site'");
                    }
                }
                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$user',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls', `site` = '$site'");
                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$tien' WHERE `username` = '$user' AND `site` = '$site'");
                if ($u['rule'] < 66) {
                    if ($tien >= 1000000) {
                        mysqli_query($db, "UPDATE `member` SET `rule` = '66' WHERE `username` = '$user' AND `site` = '$site'");
                    }
                }
                $tx = 'Nap Qua AUTO Momo (mlike #' . $tranid . ')';
                $hi = 'AUTO MOMO';
                mysqli_query($db, "INSERT INTO `momo` SET `user` = '$user',`vnd` = '$tien',`tranid`='$tranid',`time`='$time', `text`='$tx',`app`='$hi', `hien` = '0', `site` = 'mlike.vn'");
            }
        }
    }
}
