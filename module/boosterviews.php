<?php
function boosterviews($id, $sv, $sl)
{
    $data = array(
        'key' => '2ec63f4a1ed1d4422807642dcdade8e1',
        'action' => 'add',
        'service' => $sv,
        'link' => $id,
        'quantity' => $sl,
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://boosterviews.com/api/v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0',
            'Content-Type: application/x-www-form-urlencoded',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function boosterviews_refill($id)
{
    $data = array(
        'key' => '2ec63f4a1ed1d4422807642dcdade8e1',
        'action' => 'refill',
        'order' => $id,
    );
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://boosterviews.com/api/v2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0',
            'Content-Type: application/x-www-form-urlencoded',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
