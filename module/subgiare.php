<?php

function sgr_sub($id, $sl, $sv)
{
    if ($sv == 9) {
        $s = 'sv9';
    } elseif ($sv == 10) {
        $s = 'sv11';
    }
    $raw = 'idfb=' . $id . '&server_order=' . $s . '&amount=' . $sl . '&note=';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://subgiare.vn/api/service/facebook/sub-speed/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_HTTPHEADER => array(
            'api-token: eyJpdiI6IityeEtTYWtxTStUMCsyajY3SnNCNmc9PSIsInZhbHVlIjoianlULzBDb1lWREVubFF5S2U2aEZiMGlCMmlUS3JENTVmcElmVjVBMW1GOUZQL0taTVN1MHBObkdDQStxQ2FGTSIsIm1hYyI6ImZiZmFjNjNiZjQzYTNjM2VjMzQxYjE3Yjk4NjFmN2FjNThkZmQxNWJjZTg2NmY2MGU4ZTg1NTgyZDlhN2ViNGUiLCJ0YWciOiIifQ=='
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function sgr_ttfollow($link_post, $server_order, $amount, $note)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL                 => 'https://thuycute.hoangvanlinh.vn/api/service/tiktok/sub/order',
        CURLOPT_RETURNTRANSFER      => true,
        CURLOPT_ENCODING            => '',
        CURLOPT_FOLLOWLOCATION      => true,
        CURLOPT_HTTP_VERSION        => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST       => 'POST',
        CURLOPT_POSTFIELDS          => json_encode(array(
            'username'            => $link_post,
            'server_order'          => $server_order,
            'amount'                => $amount,
            'note'                  => $note
        )),
        CURLOPT_HTTPHEADER          => array(
            'api-token: eyJpdiI6Imx1Z09ubmtyNGxIa3NETkgvWXFRVGc9PSIsInZhbHVlIjoiU1lSVXk2MjIwNXFVa2poc25FUHg2UlNDZjc3YVVHaWtGVGJueUdPWkppREZBV09oYmZWMEhJYkVjeWRFWkszL1ZzeURZbThRU1J2am9oeWtocTc3d2NLbGgyNWg1VStSS3g1SUZxSXpmRTU2ZG4rankvV1FmTHBzRmdVb2VXTDlEQUN4MVl2T01iYmhCOUl6bVFWMzVBPT0iLCJtYWMiOiJmYWFhNmY3ZjdjZDU3MDJmOTFhMzZhNjdmZWE0NGYxOTdiOGI5YTYzMmE4N2MwZDE3Y2Y4YjQxNTg4ODcxOTQ5IiwidGFnIjoiIn0',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function sgr_ttlike($link_post, $server_order, $amount, $note)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL                 => 'https://thuycute.hoangvanlinh.vn/api/service/tiktok/like/order',
        CURLOPT_RETURNTRANSFER      => true,
        CURLOPT_ENCODING            => '',
        CURLOPT_FOLLOWLOCATION      => true,
        CURLOPT_HTTP_VERSION        => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST       => 'POST',
        CURLOPT_POSTFIELDS          => json_encode(array(
            'link_video'            => $link_post,
            'server_order'          => $server_order,
            'amount'                => $amount,
            'note'                  => $note
        )),
        CURLOPT_HTTPHEADER          => array(
            'api-token: eyJpdiI6Imx1Z09ubmtyNGxIa3NETkgvWXFRVGc9PSIsInZhbHVlIjoiU1lSVXk2MjIwNXFVa2poc25FUHg2UlNDZjc3YVVHaWtGVGJueUdPWkppREZBV09oYmZWMEhJYkVjeWRFWkszL1ZzeURZbThRU1J2am9oeWtocTc3d2NLbGgyNWg1VStSS3g1SUZxSXpmRTU2ZG4rankvV1FmTHBzRmdVb2VXTDlEQUN4MVl2T01iYmhCOUl6bVFWMzVBPT0iLCJtYWMiOiJmYWFhNmY3ZjdjZDU3MDJmOTFhMzZhNjdmZWE0NGYxOTdiOGI5YTYzMmE4N2MwZDE3Y2Y4YjQxNTg4ODcxOTQ5IiwidGFnIjoiIn0',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function sgr_likenew($id, $sl)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://thuycute.hoangvanlinh.vn/api/service/facebook/like-post-speed/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'idpost=' . $id . '&server_order=sv6&reaction=like&speed=fast&amount=' . $sl . '&note=hdquandev',
        CURLOPT_HTTPHEADER => array(
            'Api-Token: eyJpdiI6IlA2dC82WXhyMmFyNWRzVHRnK2dOT3c9PSIsInZhbHVlIjoiZUtLYWxPU1BQeHcwTFY4Z1EyY2p6RGFkT1VjUzI0ZUpJN250TElBUHU4OEFGWEI2aFpQUjBOVXl6Ym1XNWVjeENrSlVLRzJoRndYMU1XbHcrMUlYMEVYbXFlZkViNHUxY0EyeHZFL0pPQUxvNzZESEU0ckFiNWJzZVp4MTh6TnZuUEhVRmIzT3pRK1dOUzFHQUd3OEFRPT0iLCJtYWMiOiIzMjRhY2YxNmJlY2EwMGEzYTM4NDg1NDMzNjhmOWJkYjRhY2I1YjI0YTYxNzEwNzEzZDFiZWU3Y2RmZDRlY2M4IiwidGFnIjoiIn0=',
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
