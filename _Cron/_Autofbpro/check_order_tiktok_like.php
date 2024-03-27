<?php

$hdq = 'ok';
require_once('../../_System/db.php');
include('../../module/autofbpro.php');
require_once('../../module/vnfb.php');
$quan = tiktok_check("like");
$giai = json_decode($quan, true);
$info = $giai["data"];
for($i = 0;$i < count($info[$i]);$i++) {
    $id = $info[$i]['object_id'];
    $tko = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'tiktok_like' AND `sttdone` = '0'");
    $tko = mysqli_num_rows($tko);
    if($tko != 0) {
        $done = $info[$i]['count_success'];
        $u = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'tiktok_like' AND `sttdone` = '0'");
        $u = mysqli_fetch_assoc($u);
        $goc = $u['sl'];
        mysqli_query($db, "UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'tiktok_like'");
        echo 'id: '.$id.' -> '.$done.'<br>';

        if($done >= 1 && $done < $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'tiktok_like' AND `sttdone` = '0'");
        } elseif($done >= $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'tiktok_like'");
        }
    }
}

$result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_like' AND `nse` = 'Server Like 3' AND `sttdone` = '0' ORDER BY id DESC LIMIT 15");
while($ro = mysqli_fetch_assoc($result1)) {
    $id = $ro['profile']; //id bai viet
    $ids = $ro['idgd'];
    $result = check_likett_vnfb("$ids");
    $quan = json_decode($result);
    if($quan->success = 0) {
        echo 'lỗi rồi';
    } else {
        $done = $quan->data[0]->run_count;
        mysqli_query($db, "UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id' AND `dv` = 'tiktok_like'");
        echo 'id: '.$id.' -> '.$done.'<br>';
        $goc = $ro['sl'];
        if($done >= 1 && $done < $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'tiktok_like'");
        } elseif($done >= $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'tiktok_like'");
        }
    }

}
//echo $quan;
