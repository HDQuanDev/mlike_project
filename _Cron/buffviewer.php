<?php
$hdq = 'ok';
require_once('../_System/db.php');
require_once('../module/buffviewer.php');
$time_now = time();
$result = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv`='tiktok_view' AND `idgd` IS NOT NULL AND `time_refill` > $time_now");
$idgd_array = array();
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $time = $row['time'];
    $next2month = strtotime('+2 month', $time);
    if ($time < $next2month) {
        $i++;
        $idgd_array[] = $row['idgd'];
    }
    if ($i == 50) {
        break;
    }
}

$idgd_string = implode(",", $idgd_array);

$send = bv_refill_view($idgd_string);
$response = json_decode($send, true);

if ($response['status'] == true) {
    $count = count($response['data']);
    for ($i = 0; $i < $count; $i++) {
        $id = $response['data'][$i]['id'];
        $status = $response['data'][$i]['status'];
        $message = $response['data'][$i]['message'];
        if ($status == false) {
            if ($message == "Đơn hàng không phải trạng thái hoàn thành") {
                $time_refill = strtotime('+35 hour', $time_now);
            } else {
                $tach = explode("|", $message);
                $time_tach = $tach[1];
                $time_tach = trim($tach[1]);
                $time_refill = strtotime($time_tach);
            }
        } else {
            $time_refill = strtotime('+31 hour', $time_now);
        }
        mysqli_query($db, "UPDATE `dv_other` SET `time_refill`='$time_refill' WHERE `idgd`='$id'");
        echo $id . " - " . $status . " - " . $message . "<br>";
    }
}
