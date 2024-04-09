<?php

function sgr($id, $sl)
{
    $api = 'eyJpdiI6InBBeXorMlM0NzhtaWoxN1FIMFQ3c3c9PSIsInZhbHVlIjoia0I2ejhwdTMreFRpWlhsd2NuLy9QRFpwSXNJS3ZMcnp3NjlHN1VIWGhCN3g5N21rSHluUE1ySC9EL2ZUTHNDcSIsIm1hYyI6ImQ3MWJiNzY4NDVkZGI2YmEzZWMyNzMwNzg5MDk2OWFkYmQ2ZWQwNjk4MmZhM2VhY2Q4ZDY2NmJlMDkzMDVjOGEiLCJ0YWciOiIifQ';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://subgiare.vn/api/service/facebook/sub-vip/order',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('idfb' => '' . $id . '', 'amount' => '' . $sl . '', 'server_order' => 'sv1', 'note' => 'mlike'),
        CURLOPT_HTTPHEADER => array(
            'api-token: ' . $api
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
