<?php

$hdq = 'ok';
require_once('../../_System/db.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$data = '{"api":"w4fl4Ry0YnlnHkZ9Vxispp7X6S3cYVfyRcBe","sdt":"0987777059","time":"1"}';
$raw = 'https://momo.mlike.vn/api.php';
$postdata = json_encode($data);
$ch = curl_init($raw);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response = curl_exec($ch);
curl_close($ch);
$quan = json_decode($response);
$data = json_decode($response, true);
foreach ($data["data"] as $value) {
    $name = $value["tenck"];
    $tien = $value["tien"];
    $sdt = $value["sdtck"];
    $id = $value["idgd"];
    $nd = $value["nd"];
    $time = $value["time"];
    $sub = 'like';
    if (strpos($nd, $sub) !== false) {
        $user = substr($nd, 6);
        $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$user'");
        $tko = mysqli_num_rows($tko);
        if($tko !== 0) {
            $cgd = mysqli_query($db, "SELECT * FROM `momo` WHERE `tranid` = '$id'");
            $cgd = mysqli_num_rows($cgd);
            if($cgd == 0) {
                $u = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$user'");
                $u = mysqli_fetch_assoc($u);
                $time = time();
                $dd = $u['vnd'];
                $nd1 = 'Nạp tiền vào tài khoản:';
                $gtls = '+';
                $bd = $tien;
                if($tien > $s['minref']) {
                    if($u['ref'] !== '0') {
                        $uref = $u['ref'];
                    } else {
                        $uref = 'dramasee';
                    }
                    if(isset($uref)) {
                        $ref = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$uref' LIMIT 1");
                        $ref = mysqli_fetch_assoc($ref);
                        $ckref = $s['ckref'];
                        $cref = $tien / 100 * $ckref;
                        $rbd = $ref['vnd'];
                        $nd = 'Nhận tiền từ hoa hồng giới thiệu:';
                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd',`bd` = '$cref',`user`='$uref',`time`='$time', `loai` = '2', `goc` = '$rbd', `idgd` = '$cref', `gt` = '+'");
                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$cref' WHERE `username` = '$uref'");
                        mysqli_query($db, "UPDATE `member` SET `vndgt` = `vndgt`+'$cref' WHERE `username` = '$user'");
                    }
                }
                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$user',`time`='$time', `loai` = '2', `goc` = '$dd', `idgd` = '$bd', `gt` = '$gtls'");
                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`+'$tien' WHERE `username` = '$user'");
                mysqli_query($db, "INSERT INTO `momo` SET `user` = '$user',`vnd` = '$tien',`tranid`='$id',`time`='$time'");
            }

        }
    }

}
