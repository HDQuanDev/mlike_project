<?php

function view($id, $sl, $td, $mgr)
{
    $curl = curl_init();
    $header = array("authorization:HqYmel9sv2XkdhtOLg3nINb5uUzQoAR6PiyMjpGT471BfaKcxw", "language:vi", "content-type:application/json");
    $data = array();
    $data[0]['post_id'] = $id;
    $data[0]['amount'] = $sl;
    $data[0]['type'] = 1;
    if ($mgr != 'quandz') {
        $data[0]['discount_code'] = $mgr;
    }
    $data[0]['speed'] = $td;
    $data[0]['server_id'] = 1;
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

function check_view($sv)
{
    $curl = curl_init();

    $header = array("cookie:_ga=GA1.2.1146413876.1637947508; _gid=GA1.2.1071640601.1637947508; _gat_gtag_UA_121321719_1=1; remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6IjdUZXdQVE4zc3VxXC9TRXlPeWZQYnd3PT0iLCJ2YWx1ZSI6InZyRE9zT1p6ZU1XVzRYTzBPNVd1WlBGQ2hYR2VCdDRsMnVLOGtKekVLVHB6YTJLRGxtdzNTTU80MHZTSml4T0crT1wvVWlrZVB6OGZEelA0MUwzVVZTN1VjVVpuWTVMeU5UcTd4RHEyNEhLSCtLQlwvUGxtS0N6OVwvbml4Q3lGbHdXdjd6dk0yZ2RTb0NpT1dvNHBiaXlCWjhVSERuTkF5ZHFlazhKc2pCd1NHST0iLCJtYWMiOiIxOWVjODJmYzBmNjhlMjk2YWFlOTFhOGVkNTMzMjhlNDY2ZmY1YTZjYjAwZWEwNDFkMWU1YTQxNzZjMmQwY2QwIn0=; XSRF-TOKEN=eyJpdiI6IjlabUVEM1k2T0xQZGZ5NGZRaE5zN0E9PSIsInZhbHVlIjoiT040YVNOWGdYZ3VJWGhaSG1uZnA3WWhReFdKRTB3czdydHd5dnU0ZHZPWkdiUnM2K25EcjBUS1MxRGN4bEp0aSIsIm1hYyI6ImNhOTFmZTBiMmQ3NDJhZmI1YTRiOTlhOTAwZjIxZmQ1OGIzZTFkMzAwZWQ4ODNkMGI4NmVmM2U1ZmI0YmZkYzcifQ==; buff_viewer_session=eyJpdiI6IndHQUNZSHlVaW5mTHdWdVhDZk5iNmc9PSIsInZhbHVlIjoiUXc1QzNBWmxMbnM3elwvVTVrTXBkZm9SdkdSNDZlNlQxOFlpRkdTakxmUG1pS0V1OUdqYThSekQ5XC9ubjg0MlpXIiwibWFjIjoiZDVmODczODYzMzBjNWUxOWRiZGM5MTNkMzQ5Mjk1MzE0ZDMyYmVjNjI1ZTgzZTYxZGE2MWZkOGNlYjFjZjFjYSJ9", "language:vi", "content-type:application/json");

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://buffviewer.com/dashboard/getavailableamountorder",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "GET",

        CURLOPT_HTTPHEADER => $header,

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);
    $quan = json_decode($response);
    if ($quan->status == true) {
        if ($sv == 1) {
            $result = $quan->amount_view_video_unit_normal_available;
        } elseif ($sv == 2) {
            $result = $quan->amount_view_video_unit_fast_available;
        } elseif ($sv == 3) {
            $result = $quan->amount_view_video_unit_priority_available;
        }
    } else {
        $result = 'liên hệ admin';
    }
    return $result;
}

function view_autofb($id, $sl)
{

    $raw = '{"dataform":{"id_video":"' . $id . '","species_buff":0,"sl_view":' . $sl . '},"id":1466,"type_api":"buff_view_video"}';
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
            "ht-token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTQ2NiwidXNlcm5hbWUiOiJhdXRvZmJwcm8iLCJtb25leSI6MjA4MzI3MTIsInR5cGUiOjAsImNyZWF0ZV9hdCI6IjE1OTcyMjMxNTYiLCJlbWFpbCI6ImF1dG9mYkBnbWFpbC5jb20iLCJmYWNlYm9va19pZCI6IjEwMDAwMzQ2NDgzNjczNDgiLCJwaG9uZSI6IjAxMjM0NTY3ODkiLCJuYW1lIjoidXNlciIsInBlcmNlbnQiOjAsIm5vdGVzIjoixJBhzKNpIEx5zIEiLCJ1cGRhdGVfYXQiOiIxNjA2ODEwMzExIiwidGllbl9uYXAiOjIwOTI4MTA5OSwiaWF0IjoxNjI0ODkyOTA0LCJleHAiOjE2NTY0NDk4MzB9.5sOGybj5SFBC-uATbDKt0I9t81hWeklijPaKMMiGFw8"
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
