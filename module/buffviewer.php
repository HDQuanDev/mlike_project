<?php

function bv_viewtt($id, $sl, $sv)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://buffviewer.com/api/ordertiktok/add-order-view',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"url":"' . $id . '","amount":"' . $sl . '","server_id":"' . $sv . '","discount_code":""}',
        CURLOPT_HTTPHEADER => array(
            'authorization: HqYmel9sv2XkdhtOLg3nINb5uUzQoAR6PiyMjpGT471BfaKcxw',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function bv_refill_view($id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://buffviewer.com/api/ordertiktok/refill-view',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"ids":[' . $id . ']}',
        CURLOPT_HTTPHEADER => array(
            'authorization: HqYmel9sv2XkdhtOLg3nINb5uUzQoAR6PiyMjpGT471BfaKcxw',
            'language: vi',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
function bv_viewfb($id, $sl, $sv, $mgr)
{
    $curl = curl_init();
    $header = array("authorization:HqYmel9sv2XkdhtOLg3nINb5uUzQoAR6PiyMjpGT471BfaKcxw", "language:vi", "content-type:application/json");
    $data = array();
    $data[0]['post_id'] = $id;
    $data[0]['amount'] = $sl;
    $data[0]['type'] = 1;
    if ($mgr == 'quandz') {
    } else {
        $data[0]['discount_code'] = $mgr;
    }
    $data[0]['server_id'] = $sv;
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://buffviewer.com/api/orderviewvideounit/add",
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
    return $response;
}
