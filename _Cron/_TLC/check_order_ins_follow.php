<?php

$hdq = 'ok';
require_once('../../_System/db.php');
$result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'ins_follow' AND `idgd` = '5' AND `sttdone` = '1' ORDER BY id DESC LIMIT 20");
while($ro = mysqli_fetch_assoc($result1)) {
    $done = rand(1, 10);
    $id = $ro['profile'];
    $goc = $ro['sl'];
    $dd = $ro['done'];
    $done = $done + $dd;
    if($done >= $goc) {
        mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `done` = '$done', `idgd` = '6' WHERE `profile` = '$id' AND `dv` = 'ins_follow' AND `sttdone` = '1'");
        echo 'id: '.$id.' -> Done: '.$done.'<br>';
    } else {
        mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3', `done` = '$done'  WHERE `profile` = '$id' AND `dv` = 'ins_follow' AND `sttdone` = '1'");
        echo 'id: '.$id.' -> Done: '.$done.'<br>';
    }




}
//echo $quan;
