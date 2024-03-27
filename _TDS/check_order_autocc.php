<?php

$hdq = 'ok';
require_once('../_System/db.php');
$result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '10' AND `sttdone` = '0' ORDER BY id DESC LIMIT 10");
while($ro = mysqli_fetch_assoc($result1)) {
    $idgd = $ro['iddon'];
    $data = '{
    "service_codes": ["'.$idgd.'"]
}
';
    $raw = 'https://api.autolike.cc/public-api/v1/agency/services/all-by-codes';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $raw);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'token: S4X92NRH9PVD2WAMRH45LR6AQBJAPVRA';
    $headers[] = 'agency-secret-key: 279890eb-9833-11eb-a453-d09466848fec';
    $headers[] = 'Cookie: __cfduid=dbd2a4e5f2811b711018f1a21fa871d9c1619179213';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    // echo $response;
    curl_close($ch);
    $quan = json_decode($response);
    if($quan->data) {
        $success = $quan->data[0]->number_success;
        mysqli_query($db, "UPDATE `dichvu` SET `done` = '$success' WHERE `iddon` = '$idgd'");
        echo 'id: '.$ro['id'].' -> '.$success.'<br>';
        $goc = $ro['sl'];
        if($success >= 1 && $success < $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3' WHERE `iddon` = '$idgd'");
        } elseif($success >= $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `iddon` = '$idgd'");
        }
    }
}
