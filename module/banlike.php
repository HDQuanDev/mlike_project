<?php

function login_liketds($user, $pass)
{

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://banlike.vn/model/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "username=$user&password=$pass",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://liketds.com",
            "user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
            "x-requested-with: XMLHttpRequest"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

function send_liketds($idpost, $limit)
{
    $login = login_liketds('liketds', 'quandz');
    $login = json_decode($login);
    if ($login->status == 'success') {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://banlike.vn/model/Client/buy1.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "id=$idpost&type=bufflike&qty=$limit&note=quandz",
            CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
            CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "origin: https://liketds.com",
                "user-agent: Mozilla/5.0 (Windows NT 10.0in64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36",
                "x-requested-with: XMLHttpRequest"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
    } else {
        $response = $login->msg;
    }
    return $response;
}
