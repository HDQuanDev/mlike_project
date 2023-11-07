<?php

function login($user, $pass)
{

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/scr/login.php",
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
            "origin: https://traodoisub.com",
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

function send_tds($idpost, $limit, $note, $datetime)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/mua/like/themid.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sl=$limit&dateTime=$datetime",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_share($idpost, $limit, $note, $datetime, $sv)
{
    if ($sv == 1) {
        $url = "https://traodoisub.com/mua/share/themid.php";
    } elseif ($sv == 2) {
        $url = "https://traodoisub.com/mua/shareao/themid.php";
    }
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sl=$limit&dateTime=$datetime",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_ttcmt($idpost, $limit, $note, $datetime, $noidung)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/mua/tiktok_comment/themid.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sl=$limit&dateTime=$datetime&noidung=$noidung",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_story($idpost, $limit, $note, $datetime)
{

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/mua/viewstr/themid.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sl=$limit&dateTime=$datetime",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_cx($idpost, $limit, $note, $datetime, $cx)
{
    $cxx = strtoupper($cx);
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/mua/reaction/themid.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sl=$limit&dateTime=$datetime&loaicx=$cxx",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_likecmt($idpost, $limit, $note, $datetime, $cx)
{
    $cxx = strtoupper($cx);
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/mua/reactioncmt/themid.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sl=$limit&dateTime=$datetime&loaicx=$cxx",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_tt($dv, $idpost, $limit, $note, $datetime)
{
    if ($dv == 'like') {
        $url = 'https://traodoisub.com/mua/tiktok_like/themid.php';
    } elseif ($dv == 'follow') {
        $url = 'https://traodoisub.com/mua/tiktok_follow/themid.php';
    }
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sl=$limit&dateTime=$datetime",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_live($idpost, $limit, $tg, $datetime)
{
    $url = 'https://traodoisub.com/mua/matlivestream/themid.php';
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=a&id=$idpost&sl=$limit&timeLive=$tg&delay=0.1&dateTime=$datetime",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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

function send_tds_viplike($idpost, $note, $datetime, $day, $like)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/mua/viplike/themid.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "maghinho=$note&id=$idpost&sever=1&time_pack=$day&packet=$like&dateTime=$datetime",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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
function check_ls_like($id)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://traodoisub.com/mua/likevip/fetch.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "page=1&query=$id",
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "origin: https://traodoisub.com",
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
