<?php
$hdq = "ok";
require_once('../_System/db.php');
$t = time();
$stat = mysqli_query($db, "SELECT * FROM `ttstat` WHERE `id` = '1'");
$stat = mysqli_fetch_assoc($stat);
$luong = $stat['luong'];
$ltime = $stat['time'];
$sleep = $stat['sleep'];
$result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' AND `profile` > '0' AND `time` > '1699909582' AND (`trangthai` = '1' OR `trangthai` = '3') AND `timedown` < '$t' ORDER BY id ASC LIMIT $luong");
while ($ro = mysqli_fetch_assoc($result1)) {
    $ctime = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' AND `time` > '1699909582' AND (`trangthai` = '1' OR `trangthai` = '3')");
    $ctime = mysqli_num_rows($ctime);
    $gtime = $ctime / $luong * $ltime * 60;
    $id = $ro['id'];
    $ur = $ro['profile'];
    $time = time();
    $mtime = $gtime + $time + $sleep;
    if (filter_var($ur, FILTER_VALIDATE_URL) == false) {
        $url = "https://www.tiktok.com/@tiktok/video/" . $ur;
    } else {
        $url = $ur;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://shopviaads247.com/api/tiktok.php?type=video',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'url=' . $url,
        CURLOPT_HTTPHEADER => array(
            'TOKEN_AU: huaducquanapi',
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $check = json_decode($response);
    if ($check->success == '200') {
        $ddview = $check->data->playCount;
        $gview = $ro['iddon'];
        $sl = $ro['sl'];
        $view = (int)$gview + (int)$sl;
        $dview = (int)$ddview + (int)$gview;
        $steps = $ro['steps'];
        $count_step = 3 - $steps;
        if ($ddview >= $view) {
            $trangthai = '2';
        } else {
            $trangthai = '3';
        }
        mysqli_query($db, "UPDATE `dv_other` SET `timedown` = '$mtime', `done`='$ddview', `trangthai`='$trangthai', `timeup`='$time' WHERE `id` = '$id'");
        mysqli_query($db, "UPDATE `ttstat` SET `success`=`success`+'1' WHERE `id` = '1'");
        echo ' ' . $id . ' -> success<br>';
        $fp = @fopen('logview.txt', "a+");
        $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> success
            ';
        fwrite($fp, $data);
    } elseif ($check->success == '400') {
        if ($steps <= 3) {
            mysqli_query($db, "UPDATE `dv_other` SET `steps`=`steps`+'1', `timedown`='$mtime' WHERE `id` = '$id'");
            echo '' . $id . ' -> step<br>';
            $fp = @fopen('logview.txt', "a+");
            $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> loi link cho thu lai sau ' . $count_step . ' lan
            ';
            fwrite($fp, $data);
        } else {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai`='6', `timeup`='$time' WHERE `id` = '$id'");
            mysqli_query($db, "UPDATE `ttstat` SET `error`=`error`+'1' WHERE `id` = '1'");
            echo '' . $id . ' -> link die<br>';
            $fp = @fopen('logview.txt', "a+");
            $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> error
            ';
            fwrite($fp, $data);
        }
    } else {
        mysqli_query($db, "UPDATE `ttstat` SET `error`=`error`+'1' WHERE `id` = '1'");
        mysqli_query($db, "UPDATE `dv_other` SET `timedown`='$mtime' WHERE `id` = '$id'");
        echo '' . $id . ' -> error<br>';
        $fp = @fopen('logview.txt', "a+");
        $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> error
            ';
        fwrite($fp, $data);
    }
    mysqli_query($db, "UPDATE `ttstat` SET `timerun`='$time' WHERE `id` = '1'");
}
