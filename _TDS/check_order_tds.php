<?php

$hdq = 'login';
require_once('../_System/db.php');
require_once('../module/tds.php');
$time = time();
$user = $s['user'];
$pass = $s['pass'];
$login_tds = json_decode(login($user, urlencode($pass)));
if ($login_tds->success == 'true') {
    $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '1' AND `bh` = '1' AND `sve` = 'Server Like 1' AND `sttdone` = '0' AND `time` > '1678334026' ORDER BY id DESC LIMIT 15");
    while ($ro = mysqli_fetch_assoc($result1)) {
        $id = $ro['id'];
        $uid = $ro['profile'];
        $check = check_ls_like($uid);
        $quan = json_decode($check, true);
        $info = $quan["data"][0];
        if (isset($info)) {
            $done = $quan["data"][0]["datang"];
            mysqli_query($db, "UPDATE `dichvu` SET `done` = '$done' WHERE `id` = '$id'");
            echo 'id: ' . $id . ' -> ' . $done . '<br>';
            $goc = $ro['sl'];
            if ($done >= 1 && $done < $goc) {
                mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3' WHERE `id` = '$id'");
            } elseif ($done >= $goc) {
                mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `id` = '$id'");
            }
        }
    }
}
