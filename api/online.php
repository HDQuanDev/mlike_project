<?php
$hdq = 'login';
require_once('../_System/db.php');
$dz = time()-300;
$ckid = mysqli_query($db,"SELECT * FROM `online` WHERE `time` > '$dz'");
$ckid = mysqli_num_rows($ckid);
echo '{"online":'.$ckid.'}';
  ?>