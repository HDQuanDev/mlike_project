<?php
$hdq = "ok";
require_once('../_System/db.php');
$t = time();
$stat = mysqli_query($db, "SELECT * FROM `ttstat` WHERE `id` = '1'");
$stat = mysqli_fetch_assoc($stat);
$luong = $stat['luong'];
$ltime = $stat['time'];
$sleep = $stat['sleep'];
$result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' AND `profile` > '0' AND `time` > '1703955600' AND (`trangthai` = '1' OR `trangthai` = '3') AND `timedown` < '$t' ORDER BY id ASC LIMIT $luong");
while ($ro = mysqli_fetch_assoc($result1)) {
    $ctime = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'tiktok_view' AND `time` > '1703955600' AND (`trangthai` = '1' OR `trangthai` = '3')");
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
    $get_url = rand(2, 3);
    if ($get_url == 1) {
        $url_run = 'http://216.9.227.50/tiktok.php?type=video';
        $ip_sv = '185.113.114.51';
    } elseif ($get_url == 2) {
        $url_run = 'https://shopviaads247.com/api/tiktok.php?type=video';
        $ip_sv = '185.113.114.52';
    } elseif ($get_url == 3) {
        $url_run = 'https://tkb.qdevs.tech/api/tiktok.php?type=video';
        $ip_sv = '185.113.114.53';
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url_run,
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
    $steps = $ro['steps'];
    $count_step = 3 - $steps;
    if ($check->success == '200') {
        $ddview = $check->data->playCount;
        $gview = $ro['iddon'];
        $sl = $ro['sl'];
        $view = (int)$gview + (int)$sl;
        $dview = (int)$ddview + (int)$gview;
        if ($ddview >= $view) {
            $trangthai = '2';
            $text_tt = 'Đã hoàn thành';
        } else {
            $trangthai = '3';
            $text_tt = 'Đang chạy';
        }
        mysqli_query($db, "UPDATE `dv_other` SET `timedown` = '$mtime', `done`='$ddview', `trangthai`='$trangthai', `timeup`='$time' WHERE `id` = '$id'");
        mysqli_query($db, "UPDATE `ttstat` SET `success`=`success`+'1' WHERE `id` = '1'");
        echo ' ' . $id . ' -> success<br>';
        $fp = @fopen('logview.txt', "a+");
        $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> success [result: ' . $text_tt . '] [run on server ' . $get_url . ' (ip ' . $ip_sv . ')]
            ';
        fwrite($fp, $data);
    } elseif ($check->success == '400') {
        if ($steps <= 3) {
            mysqli_query($db, "UPDATE `dv_other` SET `steps`=`steps`+'1', `timedown`='$mtime' WHERE `id` = '$id'");
            echo '' . $id . ' -> step<br>';
            $fp = @fopen('logview.txt', "a+");
            $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> loi link cho thu lai sau ' . $count_step . ' lan [run on server ' . $get_url . ' (ip ' . $ip_sv . ')]
            ';
            fwrite($fp, $data);
        } else {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai`='6', `timeup`='$time' WHERE `id` = '$id'");
            mysqli_query($db, "UPDATE `ttstat` SET `error`=`error`+'1' WHERE `id` = '1'");
            echo '' . $id . ' -> link die<br>';
            $fp = @fopen('logview.txt', "a+");
            $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> error [result: Link Loi] [run on server ' . $get_url . ' (ip ' . $ip_sv . ')]
            ';
            fwrite($fp, $data);
        }
    } else {
        mysqli_query($db, "UPDATE `ttstat` SET `error`=`error`+'1' WHERE `id` = '1'");
        mysqli_query($db, "UPDATE `dv_other` SET `timedown`='$mtime' WHERE `id` = '$id'");
        echo '' . $id . ' -> error<br>';
        $fp = @fopen('logview.txt', "a+");
        $data = '[' . date('H:i:s - d/m', $time) . '] ' . $id . ' -> error [result: Khong the xu ly phia server] [run on server ' . $get_url . ' (ip ' . $ip_sv . ')]
            ';
        fwrite($fp, $data);
    }
    mysqli_query($db, "UPDATE `ttstat` SET `timerun`='$time' WHERE `id` = '1'");
}
