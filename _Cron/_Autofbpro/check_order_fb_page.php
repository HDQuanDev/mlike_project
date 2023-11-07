<?php
$hdq = 'ok';
require_once('../../_System/db.php');
include('../../module/autofbpro.php');

$quan = page_check("1");
$giai = json_decode($quan, true);
$info = $giai["data"];
for($i=0;$i<count($info[$i]);$i++){
  $id = $info[$i]['object_id'];
  $tko = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0'");
				$tko = mysqli_num_rows($tko);
if($tko != 0){
  $done = $info[$i]['count_success'];
$u = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0'");
$u = mysqli_fetch_assoc($u);
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'fb_page'");
    echo 'id: '.$id.' -> '.$done.'<br>';
 
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'fb_page'");
    }
}
}

//sv 3
$quan = page_check("3");
$giai = json_decode($quan, true);
$info = $giai["data"];
//echo $quan;
for($i=0;$i<count($info);$i++){
  if($info[$i]['price_per'] == 8){
  $id = $info[$i]['object_id'];
 // echo $id;
  $tko = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0' AND `nse` = 'Server Fanpage 3'");
				$tko = mysqli_num_rows($tko);
if($tko != 0){
  $done = $info[$i]['count_success'];
  //$sgoc = $info[$i]['subscribers'];
$u = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0' AND `nse` = 'Server Fanpage 3'");
$u = mysqli_fetch_assoc($u);
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'fb_page' AND `nse` = 'Server Fanpage 3'");
    echo 'id: '.$id.' -> '.$done.'<br>';
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0' AND `nse` = 'Server Fanpage 3'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `nse` = 'Server Fanpage 3'");
    }
}
}
}

//sv 3
$quan = page_check("4");
$giai = json_decode($quan, true);
$info = $giai["data"];
//echo $quan;
for($i=0;$i<count($info);$i++){
  if($info[$i]['price_per'] == 25){
  $id = $info[$i]['object_id'];
 // echo $id;
  $tko = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0' AND `nse` = 'Server Fanpage 4'");
				$tko = mysqli_num_rows($tko);
if($tko != 0){
  $done = $info[$i]['count_success'];
  //$sgoc = $info[$i]['subscribers'];
$u = mysqli_query($db,"SELECT * FROM `dv_other` WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0' AND `nse` = 'Server Fanpage 4'");
$u = mysqli_fetch_assoc($u);
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dv_other` SET `done` = '$done' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'fb_page' AND `nse` = 'Server Fanpage 4'");
    echo 'id: '.$id.' -> '.$done.'<br>';
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `sttdone` = '0' AND `nse` = 'Server Fanpage 4'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'fb_page' AND `nse` = 'Server Fanpage 4'");
    }
}
}
}
//echo $quan;