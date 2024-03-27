<?php

$hdq = 'ok';
require_once('../../_System/db.php');
include('../../module/autofbpro.php');

$quan = tiktok_check("follow");
$giai = json_decode($quan, true);
$info = $giai["data"];
for($i = 0;$i < count($info[$i]);$i++) {
    $quan = $info[$i]['object_data_tiktok'];
    $quan = json_decode($quan);
    $id = $quan->uniqueId_tiktok;
    ;
    $tko = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'tiktok_follow' AND `sttdone` = '0'");
    $tko = mysqli_num_rows($tko);
    if($tko != 0) {
        $done = $info[$i]['count_success'];
        $u = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'tiktok_follow' AND `sttdone` = '0'");
        $u = mysqli_fetch_assoc($u);
        $goc = $u['sl'];
        mysqli_query($db, "UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'tiktok_follow'");
        echo 'id: '.$id.' -> '.$done.'<br>';

        if($done >= 1 && $done < $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'tiktok_follow' AND `sttdone` = '0'");
        } elseif($done >= $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'tiktok_follow'");
        }
    }
}
//echo $quan;
