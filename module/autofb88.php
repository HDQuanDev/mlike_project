<?php
function live8($id, $sl, $min, $sv)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.autofb88.com/api/v2/facebook-eyes/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"package_name": "' . $sv . '","object_id": "' . $id . '","quantity": ' . $sl . ',"num_minutes":' . $min . '}',
        CURLOPT_HTTPHEADER => array(
            'api-token: MTA4MTY1ODAzODI3Mw==6a34b201388883825595',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function subtt88($id, $sl)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.at88.vn/api/v2/tiktok-sub/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"package_name": "81_5", "object_id": "' . $id . '", "quantity": ' . $sl . '}',
        CURLOPT_HTTPHEADER => array(
            'api-token: MTA4MTY1ODAzODI3Mw==6a34b201388883825595',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function timtt88($id, $sl, $sv)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.at88.vn/api/v2/tiktok-like/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"package_name": "' . $sv . '", "object_id": "' . $id . '", "quantity": ' . $sl . '}',
        CURLOPT_HTTPHEADER => array(
            'api-token: MTA4MTY1ODAzODI3Mw==6a34b201388883825595',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function viewtt88($id, $sl, $sv)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.at88.vn/api/v2/tiktok-view/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"package_name": "' . $sv . '", "object_id": "' . $id . '", "quantity": ' . $sl . '}',
        CURLOPT_HTTPHEADER => array(
            'api-token: MTA4MTY1ODAzODI3Mw==6a34b201388883825595',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function likett88($id, $sl)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.at88.vn/api/v2/facebook-sale-like/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"object_id":"' . $id . '","quantity":"' . $sl . '","speed":"0","notes":"quannehihi","package_name":"30_15","object_type":"like"}',
        CURLOPT_HTTPHEADER => array(
            'api-token: MTA4MTY1ODAzODI3Mw==6a34b201388883825595',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
