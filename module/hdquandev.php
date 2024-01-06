<?php
$allowed_referer = 'mlike.vn'; // Thay đổi địa chỉ trang web của bạn ở đây
$url = $_SERVER['HTTP_REFERER'];
$tach = explode("/", $url);
if ($tach[2] !== $allowed_referer) {
    $array = [];
    $array["success"] = '400';
    $array["message"] = 'Access denied';
    $array["ip"] = $_SERVER['REMOTE_ADDR'];
    $array["url"] = $_SERVER['HTTP_REFERER'];
    $array["code_by"] = "Hứa Đức Quân - Liên hệ mua api https://www.facebook.com/quancp72h";
    die(json_encode($array));
}

if (isset($_GET['type']) && isset($_POST['url'])) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://shopmmo.co/assets/api/tiktok.php?type=' . $_GET['type'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'url=' . $_POST['url'],
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'TOKEN_AU: huaducquanapi'
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
    curl_close($curl);
}
