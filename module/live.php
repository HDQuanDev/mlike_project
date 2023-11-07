<?php

function live($id, $sl, $phut, $sv, $mgr)
{

    if ($sv == '1') {

        $s = 0;
    } elseif ($sv == '2') {

        $s = 3;
    }  elseif ($sv == '3') {

        $s = 1;
    } elseif ($sv == '4') {

        $s = 2;
    }


    $curl = curl_init();

    $header = array("authorization:HqYmel9sv2XkdhtOLg3nINb5uUzQoAR6PiyMjpGT471BfaKcxw", "language:vi", "content-type:application/json");

    $data = array();

    $data[0]['post_id'] = $id;

    $data[0]['amount'] = $sl;

    $data[0]['num_minutes'] = $phut;

    if($mgr == 'quandz'){
        
    }else{
    $data[0]['discount_code'] = $mgr;
    }

    $data[0]['server_id'] = $s;

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://buffviewer.com/api/orderlivestreamunit/add",

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

    curl_close($curl);

    return $response;
}

/*

$quan = live('299120801775657', '50', '30');

$quan = json_decode($quan);

$hi = $quan->data[0]->message[0];

echo $hi;

*/