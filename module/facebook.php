<?php
function getid_2($link)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://id.traodoisub.com/api2.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'link=' . $link,
        CURLOPT_HTTPHEADER => array(
            'sec-ch-ua: "Chromium";v="116", "Not)A;Brand";v="24", "Microsoft Edge";v="116"',
            'DNT: 1',
            'sec-ch-ua-mobile: ?0',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Edg/116.0.1938.81',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Accept: application/json, text/javascript, */*; q=0.01',
            'X-Requested-With: XMLHttpRequest',
            'sec-ch-ua-platform: "Windows"',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Dest: empty',
            'host: id.traodoisub.com'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
function getid_1($link)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.at88.vn/api/convert-uid',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"type":"like","link":"' . $link . '"}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = [];
    $data["code"] = '200';
    if ($response == 0) {
        $data["success"] = '400';
    } else {
        $data["success"] = '200';
    }
    $data["id"] = $response;
    $data["type"] = "2";
    $result = json_encode($data);
    return $result;
}

function getid($link)
{
    $send = json_decode(getid_2($link));
    if ($send->code == '200') {
        $data = [];
        $data["success"] = '200';
        $data["code"] = '200';
        $data["id"] = $send->id;
        $data["type"] = "1";
        $result = json_encode($data);
    } else {
        $send_2 = json_decode(getid_2($link));
        if ($send_2->code == '200') {
            $data = [];
            $data["success"] = '200';
            $data["code"] = '200';
            $data["id"] = $send->id;
            $data["type"] = "1";
            $result = json_encode($data);
        } else {
            $send_3 = json_decode(getid_2($link));
            if ($send_3->code == '200') {
                $data = [];
                $data["success"] = '200';
                $data["code"] = '200';
                $data["id"] = $send->id;
                $data["type"] = "1";
                $result = json_encode($data);
            } else {
                $result = getid_1($link);
            }
        }
    }
    return $result;
}
