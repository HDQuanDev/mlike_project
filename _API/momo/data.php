<?php

$hdq = 'ok';

require_once('../../_System/db.php');

date_default_timezone_set('Asia/Ho_Chi_Minh');
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://botsms.net/api/list_noti',
    CURLOPT_USERAGENT => 'MLIKE POST',
    CURLOPT_POST => 1,
    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
    CURLOPT_POSTFIELDS => http_build_query(array(
        'key_user' => 'ohervb',
        'so_luong' => '5'
    ))
));
$resp = curl_exec($curl);

$quan = json_decode($resp);
$con = count($quan);
for ($i = 0; $i <= $con; $i++) {
    $id = $quan[$i]->id;
    $app = $quan[$i]->name_app;
    $title = $quan[$i]->title;
    $content = $quan[$i]->content;
    if (strpos($content, 'like') !== false) {
        if ($app == 'MoMo') {
            $content = substr($content, 1);
            $content = substr($content, 0, -31);
            $cex = explode(' ', $content);
            $content = $cex[1];
            $tien = explode(' ', $title);
            $tien = $tien[1];
            $tien = substr($tien, 0, -2);
            $tien = filter_var($tien, FILTER_SANITIZE_NUMBER_INT);
        } elseif ($app == 'Vietcombank') {
            $ex = explode(" ", $content);
            $contentt = $ex['16'];
            $str = strpos($contentt, '.');
            if ($str === false) {
                $content = $contentt;
            } else {
                $hi = explode(".", $contentt);
                $content = $hi[0];
            }
            $tien = $ex['5'];
            $tien = substr($tien, 1);
            $tien = filter_var($tien, FILTER_SANITIZE_NUMBER_INT);
        }
        $timee = $quan[$i]->time;
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $timee);
        $time = $d->getTimestamp();
        $tcheck = $time - 3601;
        if ($quan[$i]->time !== $quan[$i - 1]->time && $quan[$i]->content !== $quan[$i - 1]->content) {
            $qc = mysqli_query($db, "SELECT * FROM `momo` WHERE `tranid` = '$id' AND `vnd` = '$tien' AND `user` = '$user' AND `time` > '$tcheck' ORDER BY id DESC LIMIT 1");
            $qc = mysqli_num_rows($qc);
            if ($qc == 0) {
                $user = $content;
                $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$user'");
                $tko = mysqli_num_rows($tko);
                if ($tko !== 0) {
                    $cgd = mysqli_query($db, "SELECT * FROM `momo` WHERE `tranid` = '$id'");
                    $cgd = mysqli_num_rows($cgd);
                    if ($cgd == 0) {
                        $u = mysqli_query($db, "SELECT * FROM `member` WHERE `username`='$user'");
                        $u = mysqli_fetch_assoc($u);
                        $time = time();
                        $dd = $u['vnd'];
                        $nd1 = '(' . $app . ') Nạp tiền vào tài khoản:';
                        $gtls = '+';
                        $bd = $tien;
                        if ($tien > $s['minref']) {
                            if ($u['ref'] !== '0') {
                                $uref = $u['ref'];
                            } else {
                                $uref = 'dramasee';
                            }
                            if (isset($uref)) {
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
                        if($u['rule'] < 66) {
                            if($tien >= 1000000) {
                                mysqli_query($db, "UPDATE `member` SET `rule` = '66' WHERE `username` = '$user'");
                            }
                        }
                        $tx = 'Nap Auto Qua #' . $app . ' (mlike #' . rand(1000000, 9999999) . ')';
                        mysqli_query($db, "INSERT INTO `momo` SET `user` = '$user',`vnd` = '$tien',`tranid`='$id',`time`='$time', `text`='$tx',`app`='$app'");
                    }
                }
            }
        }
    }
}
