<?php

function gettime($giay)
{
    $time = $giay;
    $time = date('Y-m-d H:i:s', $time);
    $dt = new DateTime($time);
    $dt->setTimezone(new DateTimeZone('UTC'));
    $result = $dt->format('Y-m-d\TH:i:s.u\Z');
    return $result;
}

function logi($e = "0")
{
    $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTQ2NiwidXNlcm5hbWUiOiJhdXRvZmJwcm8iLCJtb25leSI6MjA4MzI3MTIsInR5cGUiOjAsImNyZWF0ZV9hdCI6IjE1OTcyMjMxNTYiLCJlbWFpbCI6ImF1dG9mYkBnbWFpbC5jb20iLCJmYWNlYm9va19pZCI6IjEwMDAwMzQ2NDgzNjczNDgiLCJwaG9uZSI6IjAxMjM0NTY3ODkiLCJuYW1lIjoidXNlciIsInBlcmNlbnQiOjAsIm5vdGVzIjoixJBhzKNpIEx5zIEiLCJ1cGRhdGVfYXQiOiIxNjA2ODEwMzExIiwidGllbl9uYXAiOjIwOTI4MTA5OSwiaWF0IjoxNjI0ODkyOTA0LCJleHAiOjE2NTY0NDk4MzB9.5sOGybj5SFBC-uATbDKt0I9t81hWeklijPaKMMiGFw8';
    return $token;
}

function group($id, $sl, $sv)
{
    if ($sv == 1) {
        $gia = '5';
    } elseif ($sv == 2) {
        $gia = '45';
    } elseif ($sv == 3) {
        $gia = '23';
    }
    $raw = '{"lhi":"' . $id . '","lsct":"' . $sv . '","tennhom":"","slct":"' . $sl . '","gtmtt":' . $gia . ',"gc":"","type_api":"buffgroup"}';
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/facebook_buff/create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function group_check($e = "0")
{
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/facebook_buff/list?type_api=buffgroup&type=0&limit=0",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => "0",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/plain, */*",
            "ht-token: $token"
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

function ins($id, $sl, $dv, $sv = "1")
{
    $start = gettime(time());
    $end = gettime(time() + 604800);
    if ($dv == "like") {
        $raw = '{"lhibv":"' . $id . '","lsct":"1","cdbh":"false","cnbd":"' . $start . '","cnkt":"' . $start . '","slct":"' . $sl . '","gtmtt":46,"gc":"","id_user":1466,"type_api":"buff_like"}';
    } elseif ($dv == "sub") {
        if ($sv == 1) {
            $gia = '91';
        } elseif ($sv == 2) {
            $gia = '20';
        }
        $raw = '{"dataform":{"profile_user":"' . $id . '","loaiseeding":' . $sv . ',"startDatebh":"' . $start . '","EndDatebh":"' . $end . '","baohanh":0,"sltang":' . $sl . ',"giatien":' . $gia . ',"ghichu":""},"type_api":"buff_sub"}';
    }
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/instagram/create/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function ins_check($dv)
{
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/instagram/list/?type_api=buff_$dv&limit=0",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => "0",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/plain, */*",
            "ht-token: $token"
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

function viplike($id, $day, $like, $bv)
{
    $raw = '{"dataform":{"lsct":4,"profile_user":"' . $id . '","usernamefb":"","day_sale":' . $day . ',"min_like":' . $like . ',"max_like":' . $like . ',"slbv":' . $bv . ',"ghichu":"","giatien":460},"id_user":1466}';
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/fbvip/add?fbvip_type=viplike_clone",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function viplike_check($dv = "0")
{
    $token = logi();
    $url = 'https://autofb.pro/api/fbvip?fbvip_type=viplike_clone&type=0&limit=0';
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => "0",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/plain, */*",
            "ht-token: $token"
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

function getinfo_tiktok($id, $type)
{
    $raw = '{"data":"' . $id . '","loaiseeding":"' . $type . '"}';
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/tiktok_buff/getinfotiktok",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function tiktok($id, $sl, $dv)
{
    $start = gettime(time());
    $end = gettime(time() + 604800);
    $q = getinfo_tiktok("$id", "$dv");
    $hi = json_decode($q);
    if ($hi->status == 400) {
        $response = $hi->message;
    } else {
        $id_tiktok = $hi->data->id_video;
        $hii = json_encode($hi->data);
        if ($dv == "like") {
            $link = 'https://t.tiktok.com/i18n/share/video/' . $id . '';
            $raw = '{"dataform":{"link":"' . $link . '","profile_user":"' . $id_tiktok . '","loaiseeding":"like","startDatebh":"' . $start . '","EndDatebh":"' . $end . '","baohanh":0,"sltang":' . $sl . ',"giatien":20,"ghichu":"","list_messages":[],"infoTiktok":' . $hii . '}}';
        } elseif ($dv == "follow") {
            $raw = '{"dataform":{"link":"' . $id . '","profile_user":"' . $id . '","loaiseeding":"follow","startDatebh":"' . $start . '","EndDatebh":"' . $end . '","baohanh":0,"sltang":' . $sl . ',"giatien":46,"ghichu":"","list_messages":[],"infoTiktok":' . $hii . '}}';
        }
        $token = logi();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://autofb.pro/api/tiktok_buff/create",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $raw,
            CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
            CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "ht-token: $token"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
    return $response;
}

function tiktok_live($id, $sl, $tg)
{
    $start = gettime(time());
    $end = gettime(time() + 604800);
    $q = getinfo_tiktok("$id", "tiktok_buffmat_sv2");
    $hi = json_decode($q);
    if ($hi->status == 400) {
        $response = $hi->message;
    } else {
        $id_tiktok = $hi->data->userid_tiktok;
        $hii = json_encode($hi->data);
        $raw = '{"dataform":{"link":"' . $id . '","profile_user":"' . $id_tiktok . '","loaiseeding":"tiktok_buffmat_sv2","startDatebh":"' . $start . '","EndDatebh":"' . $end . '","baohanh":0,"sltang":' . $sl . ',"tgdtm":' . $tg . ',"giatien":2,"ghichu":"","list_messages":[],"infoTiktok":' . $hii . '}}';
        $token = logi();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://autofb.pro/api/tiktok_buff/create",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $raw,
            CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
            CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "ht-token: $token"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
    return $response;
}

function tiktok_check($dv)
{
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/tiktok_buff/list/?type_api=tiktok&limit=0&obj_search=$dv",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => "0",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/plain, */*",
            "ht-token: $token"
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

function getinfo_shopee($id, $type)
{
    if ($type == 'like') {
        $raw = '{"linkshop":"' . $id . '"}';
        $url = 'https://autofb.pro/api/shopee/getinfoproduct';
    } elseif ($type == 'follow') {
        $raw = '{"linkshop":"' . $id . '"}';
        $url = 'https://autofb.pro/api/shopee/getinfo';
    }
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function shopee($id, $sl, $dv)
{
    $id = utf8_decode(urldecode($id));
    $start = gettime(time());
    $end = gettime(time() + 604800);
    $q = getinfo_shopee("$id", "$dv");
    $hi = json_decode($q);
    if ($hi->status == 400) {
        $response = $hi->message;
    } else {
        if ($dv == "like") {
            $like_count = $hi->data->liked_count;
            $name = $hi->data->name;
            $img = $hi->data->image;
            $shopid = $hi->data->id_shop;
            $producid = $hi->data->id_product;
            $raw = '{"linkshop":"' . $id . '","shopid":"' . $shopid . '","productid":"' . $producid . '","liked_count":' . $like_count . ',"name":"' . $name . '","image":"' . $img . '","lsct":"1","cdbh":"0","slct":"' . $sl . '","gtmtt":30,"gc":""}';
            $url = 'https://autofb.pro/api/shopee/add?shopee_type=shopeetim';
        } elseif ($dv == "follow") {
            $portrait = $hi->data->data->portrait;
            $follow = $hi->data->data->follower_count;
            $shopid = $hi->data->data->shopid;
            $raw = '{"linkshop":"' . $id . '","usernameshopee":"' . $id . '","portrait":"' . $portrait . '","follower_count":' . $follow . ',"shopid":' . $shopid . ',"lsct":"sub","cdbh":"0","slct":"' . $sl . '","gtmtt":71,"gc":""}';
            $url = 'https://autofb.pro/api/shopee/add?shopee_type=shopee';
        }
        $token = logi();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $raw,
            CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
            CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "ht-token: $token"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
    return $response;
}

function shopee_check($dv)
{
    $token = logi();
    if ($dv == 'like') {
        $url = 'https://autofb.pro/api/shopee?shopee_type=shopeetim&type=0&limit=0';
    } elseif ($dv == 'follow') {
        $url = 'https://autofb.pro/api/shopee?shopee_type=shopee&type=0&limit=0';
    }
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => "0",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/plain, */*",
            "ht-token: $token"
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

function getinfo_page($id)
{
    $raw = '{"id_user":1466,"link":"' . $id . '"}';
    $url = 'https://autofb.pro/api/checklinkfb/check/';
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function page($id, $sl, $sv)
{
    $start = gettime(time());
    $end = gettime(time() + 604800);
    $q = getinfo_page("$id");
    $hi = json_decode($q);
    if ($hi->status == 400) {
        $response = $hi->message;
    } else {
        $profile_id = $hi->id;
        if ($sv == 1) {
            $s = '3';
            $gia = '35';
            $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $profile_id . '","loaiseeding":' . $s . ',"baohanh":0,"sltang":' . $sl . ',"giatien":' . $gia . ',"ghichu":"","startDatebh":"' . $start . '","EndDatebh":"' . $end . '"},"type_api":"like_page"}';
        } elseif ($sv == 2) {
            $s = '4';
            $gia = '34';
            $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $profile_id . '","loaiseeding":' . $s . ',"baohanh":0,"sltang":' . $sl . ',"giatien":' . $gia . ',"ghichu":"","startDatebh":"' . $start . '","EndDatebh":"' . $end . '"},"type_api":"like_page"}';
        } elseif ($sv == 3) {
            $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $profile_id . '","loaiseeding":1,"baohanh":0,"sltang":' . $sl . ',"giatien":8,"ghichu":"","startDatebh":"' . $start . '","EndDatebh":"' . $end . '"},"type_api":"like_page_sale"}';
        } elseif ($sv == 4) {
            $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $profile_id . '","loaiseeding":3,"baohanh":0,"sltang":' . $sl . ',"giatien":19,"ghichu":"","startDatebh":"' . $start . '","EndDatebh":"' . $end . '"},"type_api":"like_page_sale"}';
        }
        $link = 'https://autofb.pro/api/facebook_buff/create';
        $token = logi();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $raw,
            CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
            CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
            CURLOPT_HTTPHEADER => [
                "content-type: application/json",
                "ht-token: $token"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $quan = json_decode($response);
        if ($quan->status == '200') {
            $response =  '{"status":"200", "id":"' . $profile_id . '"}';
        } else {
        }
    }
    return $response;
}

function page_check($sv)
{
    $token = logi();
    if ($sv == 1 || $sv == 2) {
        $url = 'https://autofb.pro/api/facebook_buff/list/?type_api=like_page&limit=0';
    } elseif ($sv == 3 || $sv == 4) {
        $url = 'https://autofb.pro/api/facebook_buff/list/?type_api=like_page_sale&limit=0';
    }
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => "0",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/plain, */*",
            "ht-token: $token"
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

function follow($id, $sl, $sv)
{
    $start = gettime(time());
    $end = gettime(time() + 604800);
    if ($sv == 4) {
        $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $id . '","loaiseeding":3,"baohanh":0,"sltang":' . $sl . ',"giatien":6,"ghichu":"","startDatebh":"'
            . $start . '","EndDatebh":"' . $end . '"},"type_api":"buff_sub_sale"}';
    } elseif ($sv == 7) {
        $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $id . '","loaiseeding":2,"baohanh":0,"sltang":' . $sl . ',"giatien":21,"ghichu":"","startDatebh":"'
            . $start . '","EndDatebh":"' . $end . '"},"type_api":"buff_sub"}';
    } elseif ($sv == 3) {
        $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $id . '","loaiseeding":1,"baohanh":0,"sltang":' . $sl . ',"giatien":8,"ghichu":"","startDatebh":"'
            . $start . '","EndDatebh":"' . $end . '"},"type_api":"buff_sub_sale"}';
    } elseif ($sv == 2) {
        $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $id . '","loaiseeding":3,"baohanh":0,"sltang":' . $sl . ',"giatien":19,"ghichu":"","startDatebh":"'
            . $start . '","EndDatebh":"' . $end . '"},"type_api":"buff_sub_slow"}';
    } elseif ($sv == 1) {
        $raw = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":0,"locnangcao_banbe_start":0,"locnangcao_banbe_end":0,"profile_user":"' . $id . '","loaiseeding":4,"baohanh":0,"sltang":' . $sl . ',"giatien":20,"ghichu":"","startDatebh":"'
            . $start . '","EndDatebh":"' . $end . '"},"type_api":"buff_sub"}';
    }
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/facebook_buff/create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function follow_check($sv)
{
    if ($sv == 1 || $sv == 7) {
        $url = 'https://autofb.pro/api/facebook_buff/list?type_api=buff_sub&limit=0';
    } elseif ($sv == 2) {
        $url = 'https://autofb.pro/api/facebook_buff/list?type_api=buff_sub_slow&limit=0';
    } elseif ($sv == 3 || $sv == 4) {
        $url = 'https://autofb.pro/api/facebook_buff/list?type_api=buff_sub_sale&limit=0';
    }
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => "0",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json, text/plain, */*",
            "ht-token: $token"
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

function youtube($id, $sl)
{
    $start = gettime(time());
    $end = gettime(time() + 604800);
    $raw = '{"dataform":{"profile_user":"' . $id . '","loaiseeding":2,"startDatebh":"' . $start . '","EndDatebh":"' . $end . '","baohanh":0,"sltang":' . $sl . ',"giatien":697,"ghichu":""},"id_user":1466}';
    $token = logi();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://autofb.pro/api/youtube/add?youtube_type=youtube_buffsub",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $raw,
        CURLOPT_COOKIEJAR => "my_cookies_aquan.txt",
        CURLOPT_COOKIEFILE => "my_cookies_aquan.txt",
        CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "ht-token: $token"
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

function autofb_live($id, $tg, $mat, $sv, $gia)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://autofb.pro/api/facebook_buff/create',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"lvctm":"' . $id . '","lsct":"' . $sv . '","slmct":"' . $mat . '","tgdtm":"' . $tg . '","gc":"","gtmtt":' . $gia . ',"id_user":1466,"type_api":"Buff_view_livestrean"}',
        CURLOPT_HTTPHEADER => array(
            'ht-token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTQ2NiwidXNlcm5hbWUiOiJhdXRvZmJwcm8iLCJtb25leSI6NDMxMjc5MTIsInR5cGUiOjAsImNyZWF0ZV9hdCI6IjE1OTcyMjMxNTYiLCJlbWFpbCI6Im5ndXllbm5nb2N0aGFuaHNhbmcxOTk3QGdtYWlsLmNvbSIsImZhY2Vib29rX2lkIjoiMTAwMDAzNDY0ODM2NzM0OCIsInBob25lIjoiMDEyMzQ1Njc4OSIsIm5hbWUiOiJ1c2VyIiwicGVyY2VudCI6MCwibm90ZXMiOiLEkGHMo2kgTHnMgSIsInVwZGF0ZV9hdCI6IjE2NTg0NzI2MDIiLCJ0aWVuX25hcCI6NjM4NTY2MDk5LCJpYXQiOjE2NjA5ODAyMzEsImV4cCI6MTY5MjUzNzE1N30.qG8inTBF24SGHfmCR973YYHhpWyitVtIujvW6h0v5Q4',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function autofb_like($id, $sl)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://autofb.pro/api/facebook_buff/create',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":13,"locnangcao_banbe_start":0,"locnangcao_banbe_end":100,"profile_user":"' . $id . '","loaiseeding":"like_v9","baohanh":0,"sltang":' . $sl . ',"giatien":5,"ghichu":"","startDatebh":"2022-09-25T10:27:39.856Z","EndDatebh":"2022-10-02T10:27:39.856Z","type":"","list_messages":[],"tocdolike":0},"type_api":"buff_likecommentshare"}',
        CURLOPT_HTTPHEADER => array(
            'ht-token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTQ2NiwidXNlcm5hbWUiOiJhdXRvZmJwcm8iLCJtb25leSI6NDMxMjc5MTIsInR5cGUiOjAsImNyZWF0ZV9hdCI6IjE1OTcyMjMxNTYiLCJlbWFpbCI6Im5ndXllbm5nb2N0aGFuaHNhbmcxOTk3QGdtYWlsLmNvbSIsImZhY2Vib29rX2lkIjoiMTAwMDAzNDY0ODM2NzM0OCIsInBob25lIjoiMDEyMzQ1Njc4OSIsIm5hbWUiOiJ1c2VyIiwicGVyY2VudCI6MCwibm90ZXMiOiLEkGHMo2kgTHnMgSIsInVwZGF0ZV9hdCI6IjE2NTg0NzI2MDIiLCJ0aWVuX25hcCI6NjM4NTY2MDk5LCJpYXQiOjE2NjA5ODAyMzEsImV4cCI6MTY5MjUzNzE1N30.qG8inTBF24SGHfmCR973YYHhpWyitVtIujvW6h0v5Q4',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
