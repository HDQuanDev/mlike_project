<?php

$hdq = 'ok';
require_once('../../_System/db.php');
include('../../module/autofbpro.php');

$quan = viplike_check();
$giai = json_decode($quan, true);
$info = $giai["data"];
for($i = 0;$i < count($info[$i]);$i++) {
    $id = $info[$i]['object_id'];
    $ex = $info[$i]['time_expired'];
    $tko = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'fb_viplike' AND `sttdone` = '0'");
    $tko = mysqli_num_rows($tko);
    if($tko != 0) {
        $post = $info[$i]['limit_post'];
        mysqli_query($db, "UPDATE `dv_other` SET `nse` = '$post', `trangthai` = '3' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'fb_viplike'");
        echo 'id: '.$id.' -> Limit Post: '.$post.'<br>';

    }
}

## check time hết hạn
$result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'fb_viplike' AND `sttdone` = '0'");
while($ro = mysqli_fetch_assoc($result1)) {
    $id = $ro['profile'];
    $timeex = $ro['sve'];
    $time = time();
    if($time > $timeex) {
        mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '5', `sttdone` = '1' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'fb_viplike'") or die(mysqli_error($db));

    }
}

//echo $quan;
