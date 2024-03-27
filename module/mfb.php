<?php

function gettimee($giay)
{
    $time = $giay;
    $time = date('Y-m-d H:i:s', $time);
    $dt = new DateTime($time);
    $dt->setTimezone(new DateTimeZone('UTC'));
    $result = $dt->format('Y-m-d\TH:i:s.u\Z');
    return $result;
}


function mfb_cmttt($id, $cmt)
{
    $quan = explode("\n", $cmt);
    $q = array($quan);
    $qu = json_encode($quan);
    $b = count($quan);
    $gia = 686 * $b;
    $end = gettimee(time() + 604800);
    $raw = array('link' => 'https://www.tiktok.com/@', 'type' => 'comment', 'object_id' => '' . $id . '', 'quantity' => '' . $b . '', 'prices' => '' . $gia . '', 'time_expired' => '' . $end . '', 'provider' => 'tiktok', 'is_warranty' => 'false', 'list_messages' => '' . $qu . '');

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mfb.vn/api/advertising/tiktok/create',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBpLm1mYi52blwvYXBpXC9sb2dpbiIsImlhdCI6MTYzODA5NTM5NywiZXhwIjoxNjY5NjMxMzk3LCJuYmYiOjE2MzgwOTUzOTcsImp0aSI6InBrRUZZYUJ3QVJ0UVRzR0ciLCJzdWIiOjM5MDcsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.PP_T_c19M34kMvWwbdnN2RuQVItoEI6PLzSaGc1sg-0'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function mfb_likett($id, $sl)
{
    $gia = 20 * $sl;
    $end = gettimee(time() + 604800);
    $raw = array('link' => 'https://www.tiktok.com/@', 'type' => 'like', 'object_id' => '' . $id . '', 'quantity' => '' . $sl . '', 'prices' => '' . $gia . '', 'time_expired' => '' . $end . '', 'provider' => 'tiktok', 'is_warranty' => 'false');

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mfb.vn/api/advertising/tiktok/create',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBpLm1mYi52blwvYXBpXC9sb2dpbiIsImlhdCI6MTYzODA5NTM5NywiZXhwIjoxNjY5NjMxMzk3LCJuYmYiOjE2MzgwOTUzOTcsImp0aSI6InBrRUZZYUJ3QVJ0UVRzR0ciLCJzdWIiOjM5MDcsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.PP_T_c19M34kMvWwbdnN2RuQVItoEI6PLzSaGc1sg-0'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function mfb_like($id, $sl)
{
    $gia = 5 * $sl;
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://gateway.mfb.vn/api/facebook-ads/create',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{"link":"https://www.facebook.com/'.$id.'","type":"like_sv4","object_id":"pfbid0214N6e42RRJS8vzPnBm5uRKrYChKbDa5nbnb91CnoGRvHF5ubmtQ8UboBNnpGPjRil","quantity":'.$sl.',"prices":'.$gia.',"speed":"low"}',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvZ2F0ZXdheS5tZmIudm5cL2FwaVwvbG9naW4iLCJpYXQiOjE2OTEzMjI1NTksImV4cCI6MTcyMjg1ODU1OSwibmJmIjoxNjkxMzIyNTU5LCJqdGkiOiJqUHNQekJlVE45a3BFMnB4Iiwic3ViIjozOTA3LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.uRW0dv2FIAq_C23dm69u52HYP2Np350Lv7ZVayslgk0',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
