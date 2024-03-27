<?php

function autocc_done($id)
{
    $data = '{
    "transaction_code": "' . $id . '"
              }';
    $raw = 'https://api.autolike.cc/public-api/v1/agency/services/confirm';
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
    curl_close($ch);
    $quan = json_decode($response);
    if ($quan->code == '200') {
        $result = 'true';
    } else {
        $result = 'false';
    }
    return $result;
}

function autocc($url, $sl, $sv)
{
    if($sv == 1) {
        $speed = 'low';
    } elseif($sv == 2) {
        $speed = 'medium';
    } elseif($sv == 3) {
        $speed = 'normal';
    } elseif($sv == 4) {
        $speed = 'high';
    }

    $data = '{
    "url_service": "' . $url . '",
    "type": "facebook_bufflike",
    "speed": "'.$speed.'",
    "number": ' . $sl . '
}
';
    $raw = 'https://agency.autolike.cc/public-api/v1/agency/services/create-V2';
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
    curl_close($ch);
    $quan = json_decode($response);
    if ($quan->code == '200') {
        $iddon = $quan->data->service_codes[0];
        $idgd = $quan->data->transaction_code;
        $done = autocc_done($idgd);
        if ($done == 'true') {
            $result = '{"iddon":"' . $iddon . '","idgd":"' . $idgd . '"}';
        } else {
            $result = 'false';
        }
    } else {
        $result = $response;
    }
    curl_close($ch);
    return $result;
}
