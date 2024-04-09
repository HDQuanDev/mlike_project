<?php

$hdq = 'ok';
require_once('../_System/db.php');
$result1 = mysqli_query($db, "SELECT * FROM `video` WHERE `dv` = 'mat' AND `sttdone` = '0' ORDER BY id DESC LIMIT 10");
while($ro = mysqli_fetch_assoc($result1)) {
    $idgd = $ro['idgd'];
    $curl = curl_init();
    $header = array("authorization:HqYmel9sv2XkdhtOLg3nINb5uUzQoAR6PiyMjpGT471BfaKcxw","language:vi","content-type:application/json");
    $data = array();
    $data['ids'] = array($idgd);
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://buffviewer.com/api/orderlivestreamunit/view",
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
    $start = $quan->data[0]->start_view;
    if($trangthai == '1') {
        $tt = '1';
        $sttdone = '0';
    } elseif($trangthai == '3') {
        $tt = '3';
        $sttdone = '0';
    } elseif($trangthai == '4') {
        $tt = '2';
        $sttdone = '1';
    } elseif($trangthai == '5') {
        $tt = '4';
        $sttdone = '0';
    } else {
        $tt = '1';
        $sttdone = '0';
    }
    mysqli_query($db, "UPDATE `video` SET `start` = '$start', `trangthai` = '$tt', `sttdone` = '$sttdone' WHERE `idgd` = '$idgd'");
    echo 'id: '.$ro['id'].' -> '.$sttdone.'<br>';
}
