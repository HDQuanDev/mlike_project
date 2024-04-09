<?php

$hdq = 'login';
require_once('../_System/db.php');
$token = $s['tlc'];
$time = time();
$result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '2' AND `sttdone` = '0' ORDER BY id DESC LIMIT 15");
while ($ro = mysqli_fetch_assoc($result1)) {
    $id = $ro['profile']; //id bai viet
    $url = 'https://tanglikecheo.com/api/history?litmit=10&object_id=' . $id . '&provider=facebook&type=like';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token;
    $headers[] = 't:' . $time;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    $result = $server_output;
    $quan = json_decode($result);
    if ($quan->success = false) {
        echo 'lỗi rồi';
    } else {
        $done = (int)$quan->data[0]->worker;
        mysqli_query($db, "UPDATE `dichvu` SET `done` = '$done' WHERE `profile` = '$id' AND `nse` = '2'");
        echo 'id: ' . $id . ' -> ' . $done . '<br>';
        $goc = $ro['sl'];
        if ($done >= 1 && $done < $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `nse` = '2'");
        } elseif ($done >= $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `nse` = '2'");
        }
    }
}

$result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Cmt' AND `nse` = '2' AND `sttdone` = '0' ORDER BY id DESC LIMIT 15");
while ($ro = mysqli_fetch_assoc($result1)) {
    $id = $ro['profile']; //id bai viet\
    $iddon = $ro['id'];
    $url = 'https://tanglikecheo.com/api/history?litmit=100&object_id=' . $id . '&provider=facebook&type=comment';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token;
    $headers[] = 't:' . $time;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    $result = $server_output;
    $quan = json_decode($result);
    if ($quan->success = false) {
        echo 'lỗi rồi';
    } else {
        $done = (int)$quan->data[0]->count_is_run;
        mysqli_query($db, "UPDATE `dichvu` SET `done` = '$done' WHERE `id` = '$iddon' AND `dv` = 'Cmt'");
        echo 'id: ' . $id . ' -> ' . $done . '<br>';
        $goc = $ro['sl'];
        if ($done >= 1 && $done < $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3' WHERE `id` = '$iddon' AND `nse` = '2'");
        } elseif ($done >= $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `id` = '$iddon' AND `nse` = '2'");
        }
    }
}
