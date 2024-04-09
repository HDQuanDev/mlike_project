<?php

function new97($id, $sl, $phut, $sv)
{
    if ($sv == '7') {
        $nsv = 'buff_mat_le_kenh2';
    } elseif ($sv == '8') {
        $nsv = 'buff_mat_le_kenh3';
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://new97.net/api_v4/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('object_id' => $id, 'amount' => $sl, 'minutes' => $phut, 'speed' => '30', 'gif' => '', 'channel' => $nsv, 'note' => 'api', 'token' => '5999a86deb09fd5b13175f513b1a18f5', 'service' => 'buff_mat_le'),
        CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=97b6a016057a73462ba239e3adfe9ed2'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
