<?php
$hdq = 'ok';
require_once('../_System/db.php');
require_once('../module/view.php');

$result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `dv` = 'view' AND `sttdone` = '0' AND `idgd` > '2003' ORDER BY id DESC LIMIT 10");
while ($ro = mysqli_fetch_assoc($result1)) {
    $idgd = $ro['idgd'];
    $curl = curl_init();
    $header = array("authorization:HqYmel9sv2XkdhtOLg3nINb5uUzQoAR6PiyMjpGT471BfaKcxw", "language:vi", "content-type:application/json");
    $data = array();
    $data['ids'] = array($idgd);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://buffviewer.com/api/orderviewvideounit/view",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => $header,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $quan = json_decode($response);
    $trangthai = $quan->data[0]->status;
    $done = $quan->data[0]->run_count;
    $start = $quan->data[0]->first_view_count;
    if ($trangthai == '1') {
        $tt = '1';
        $sttdone = '0';
    } elseif ($trangthai == '3') {
        $tt = '3';
        $sttdone = '0';
    } elseif ($trangthai == '4') {
        $tt = '2';
        $sttdone = '1';
    } elseif ($trangthai == '5') {
        $tt = '4';
        $sttdone = '0';
    } else {
        $tt = '1';
        $sttdone = '0';
    }
    mysqli_query($db, "UPDATE `video` SET `start` = '$start', `trangthai` = '$tt', `sttdone` = '$sttdone', `done` = '$done' WHERE `idgd` = '$idgd'");
    echo 'id: ' . $ro['id'] . ' -> ' . $done . '/' . $ro['sl'] . '<br>';
}


echo '<hr/>';
if ($s['congtac_viewfb'] == 'uutien') {
    $result = mysqli_query($db, "SELECT * FROM `video` WHERE `dv` = 'view' AND `auto` = '0' AND `idgd` = '2003' AND `code` = '14' AND `trangthai` = '1' ORDER BY id DESC LIMIT 1");
    while ($q = mysqli_fetch_assoc($result)) {
        $id = $q['profile'];
        $sl = $q['sl'];
        $quan = $q['id'];
        $sldon = check_view(3); // 1 : Bình thường 2 : Nhanh 3 : Ưu tiên
        if ($q['idgd'] == '2003') {
            if ($sldon > 0) {
                $buff = view($id, $sl, '1', 'quandz'); // 0 : Bình thường 1 : Nhanh 2 : Ưu tiên
                $buff = json_decode($buff);
                if ($buff->data[0]->status == 'true') {
                    $idgdd = $buff->data[0]->id;
                    mysqli_query($db, "UPDATE `video` SET `idgd` = '$idgdd', `auto` = '2' WHERE `id` = '$quan'");
                    echo 'ID: ' . $quan . ' ADD auto Success<br>';
                }
            } else {
                echo 'ID: ' . $quan . ' ADD auto Error (Het Don Hang Kha Dung, Cho Gui Lai)<br>';
            }
        }
    }
}
