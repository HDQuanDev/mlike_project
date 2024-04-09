<?php

function dailysub24h($id, $sl)
{
    $url = "https://dailysub24h.com/post-api/api-subpage/";

    $data = [
        'id_sub' => $id,
        'goi' => $sl,
        'ghichu' => "mlike",
        'server' => 1,
        'token' => 'ff64f8bbba0465daca584e758315f461'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
