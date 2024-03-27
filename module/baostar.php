<?php

function baostar($id, $sl)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.baostar.pro/api/facebook-like-gia-re/buy',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('package_name' => 'facebook_like_v3', 'quantity' => '' . $sl . '', 'object_id' => '' . $id . ''),
        CURLOPT_HTTPHEADER => array(
            'api-key: Q50y9LxYhYaCWjeJls5aRoyWd7AcrQgWU69g412yEoopmRrGG1Bda0T1EnsnIbdqyjF26bSymGKQHVBCzFbkds7Bgf69BYPHrX6HUeEDUlJuhzUM5gDVlx1HSOY7tPtE0KhvBWmP2sELFLFr3a8QoF'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function baostar_page($id, $sl)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.baostar.pro/api/facebook-like-page/buy',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{ "package_name":"facebook_like_page_sv10", "object_id":"' . $id . '", "quantity":' . $sl . ' }',
        CURLOPT_HTTPHEADER => array(
            'api-key: Q50y9LxYhYaCWjeJls5aRoyWd7AcrQgWU69g412yEoopmRrGG1Bda0T1EnsnIbdqyjF26bSymGKQHVBCzFbkds7Bgf69BYPHrX6HUeEDUlJuhzUM5gDVlx1HSOY7tPtE0KhvBWmP2sELFLFr3a8QoF',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function baostar_viplike($id, $sl, $day, $slbv)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.baostar.pro/api/facebook-vip-clone/buy',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"package_name" => "facebook_vip_clone_sale_v8", "quantity" => "' . $sl . '", "object_id" => "' . $id . '", "num_day" => "' . $day . '", "slbv" => "' . $slbv . '"}',
        CURLOPT_HTTPHEADER => array(
            'api-key: Q50y9LxYhYaCWjeJls5aRoyWd7AcrQgWU69g412yEoopmRrGG1Bda0T1EnsnIbdqyjF26bSymGKQHVBCzFbkds7Bgf69BYPHrX6HUeEDUlJuhzUM5gDVlx1HSOY7tPtE0KhvBWmP2sELFLFr3a8QoF',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function baostar_cmt($id, $cmt)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.baostar.pro/api/facebook-binh-luan/buy',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "object_id": "' . $id . '",
    "package_name": "facebook_comment_sv10",
    "list_message":"' . $cmt . '"
}',
        CURLOPT_HTTPHEADER => array(
            'api-key: Q50y9LxYhYaCWjeJls5aRoyWd7AcrQgWU69g412yEoopmRrGG1Bda0T1EnsnIbdqyjF26bSymGKQHVBCzFbkds7Bgf69BYPHrX6HUeEDUlJuhzUM5gDVlx1HSOY7tPtE0KhvBWmP2sELFLFr3a8QoF',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function baostar_live($id, $sl, $sv)
{
    if ($sv == '9') {
        $name = 'facebook_eyes_sv6';
    } elseif ($sv == '10') {
        $name = 'facebook_eyes_sv7';
    } elseif ($sv == '11') {
        $name = 'facebook_eyes_sv8';
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.baostar.pro/api/facebook-eyes/buy',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"object_id":"' . $id . '","quantity":"' . $sl . '","package_name":"' . $name . '","num_minutes":"30"}',
        CURLOPT_HTTPHEADER => array(
            'api-key: Q50y9LxYhYaCWjeJls5aRoyWd7AcrQgWU69g412yEoopmRrGG1Bda0T1EnsnIbdqyjF26bSymGKQHVBCzFbkds7Bgf69BYPHrX6HUeEDUlJuhzUM5gDVlx1HSOY7tPtE0KhvBWmP2sELFLFr3a8QoF',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
