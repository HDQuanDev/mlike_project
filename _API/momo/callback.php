<?php

$hdq = 'ok';
require_once('../../_System/db.php');
$api_key = 'quan1410200317181910'; // Lấy API KEY tại nhà cung cấp dịch vụ
// vui lòng không để lộ api và link callback để bảo mật web



// vui lòng tự bọc hàm để bảo mật tránh bị tấn công XSS, SQL
if ($_POST['ma_baoMat'] && $_POST['id_khach'] && $_POST['so_tien'] && $_POST['trans_id']) {
    $user = $_POST['id_khach'];
    $tien = $_POST['so_tien'];
    $key = $_POST['ma_baoMat'];
    $tranid =  $_POST['trans_id'];
    $q = 'quan14102003' . $key . '';
    $check1 = md5($api_key);
    $check2 = md5($q);
    if ($key != '') {
        if ($check1 == $check2) {
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
                    $tx = 'Nap Qua AUTO (mlike #' . $tranid . ')';
                    $hi = 'AUTO';
                    mysqli_query($db, "INSERT INTO `momo` SET `user` = '$user',`vnd` = '$tien',`tranid`='$tranid',`time`='$time', `text`='$tx',`app`='$hi', `hien` = '0', `site` = 'mlike.vn'");
                }
            }
        }
    }
}
echo 'ahahah';
