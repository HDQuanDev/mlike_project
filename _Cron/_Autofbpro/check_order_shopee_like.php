<?php
$hdq = 'ok';
require_once('../../_System/db.php');
include('../../module/autofbpro.php');

$quan = shopee_check("like");
$giai = json_decode($quan, true);
$info = $giai["data"];
for($i=0;$i<count($info[$i]);$i++){
  $id = $info[$i]['linkshop'];
$quan = explode('.', $id);
$id = $quan[3];
 $tko = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` LIKE '%$id' AND `dv` = 'shopee_like' AND `sttdone` = '0'");
				$tko = mysqli_num_rows($tko);
if($tko != 0){
  $done = $info[$i]['dachay'];
$u = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` LIKE '%$id' AND `dv` = 'shopee_like' AND `sttdone` = '0'");
$u = mysqli_fetch_assoc($u);
$id = $u['profile'];
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'shopee_like'");
    echo 'id: '.$id.' -> '.$done.'<br>';
 
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'shopee_like' AND `sttdone` = '0'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'shopee_like'");
    }
}
}
//echo $quan;