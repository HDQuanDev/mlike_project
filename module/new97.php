<?php

function new97($id, $sl, $phut, $sv)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://new97.net/new_2024/public/api/v1.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"link":"' . $id . '","quantity":"' . $sl . '","minutes":"' . $phut . '","gif":"","note":"api","channel":"' . $sv . '"}',
        CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=97b6a016057a73462ba239e3adfe9ed2',
            'Authorization: 5999a86deb09fd5b13175f513b1a18f5'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
