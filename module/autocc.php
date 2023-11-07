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

function autocc($url, $sl)
{
    $data = '{
    "url_service": "' . $url . '",
    "type": "bufflike",
    "number": ' . $sl . '
}
';
    $raw = 'https://api.autolike.cc/public-api/v1/agency/services/create';
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

function login_cc($tk, $mk)
{
    $data = '{"username":"' . $tk . '","password":"' . $mk . '","device_id":"7f7fb1b0-9c6f-11eb-ab3d-1564b13d3b3d"}';

    $url = 'https://api.autolike.cc/public-api/v1/users/login';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Accept: application/json';
    $headers[] = 'Token:';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    $quan = json_decode($server_output);
    $fp = @fopen('hiddenfile1410.txt', "w+");
    if ($quan->code == '200') {
        $data = $quan->data->token;
    } else {
        $data = 'no';
    }
    fwrite($fp, $data);
    return $server_output;
}

function creat_cmt($nd, $token)
{
    $qu = explode("\n", $nd);
    $qua = json_encode($qu);
   
        $rand = rand(10, 9999999999);
        $data = '{"name":"' . $rand . '","contents":' . $qua . '}';
        $url = 'https://api.autolike.cc/public-api/v1/users/comments/create';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Token: ' . $token;
        $headers[] = 'Cookie: __cfduid=dbd2a4e5f2811b711018f1a21fa871d9c1619179213';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec($ch);
        curl_close($ch);
   
    return $server_output;
}


function buff($link, $sl, $nd)
{
    $login = login_cc('0987777059', 'sanghacker');
    $login = json_decode($login);
    if ($login->code == '200') {
        $token = $login->data->token;
    $quan = creat_cmt('' . $nd . '', ''.$token.'');
    $quan = json_decode($quan);
    if ($quan->code == '200') {
        if ($token !== 'no') {
            $cmt_id = $quan->data->comment_id;
            $data = '{"url_service":"' . $link . '","comment_id":"' . $cmt_id . '","speed":"High","number":' . $sl . ',"type":"facebook_buffcomment"}';
            $url = 'https://api.autolike.cc/public-api/v1/users/services/create-permission';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Accept: application/json';
            $headers[] = 'Token: '.$token;
            $headers[] = 'Cookie: __cfduid=dbd2a4e5f2811b711018f1a21fa871d9c1619179213';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec($ch);
            curl_close($ch);
        } else {
            $server_output = '{"code":0}';
        }
    } else {
        $server_output = '{"code":0}';
    }
}
    return $server_output;
}

function autocc_follow($url, $sl)
{
    $data = '{
    "fanpage_id": "' . $url . '",
    "type": "follow",
    "number": ' . $sl . '
}
';
    $raw = 'https://api.autolike.cc/public-api/v1/agency/services/create';
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
