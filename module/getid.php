<?php


function getid_2($link)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://id.traodoisub.com/api.php',
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
    $data["success"] = '200';
    $data["code"] = '200';
    if ($response == 0) {
        $data["id"] = "Link không hợp lệ hoặc không thể Get ID vui lòng thử lại!!";
    } else {
        $data["id"] = $response;
    }
    $data["type"] = "2";
    $data["count"] = "4";
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
        $data["count"] = "1";
        $result = json_encode($data);
    } else {
        sleep(5);
        $send_2 = json_decode(getid_2($link));
        if ($send_2->code == '200') {
            $data = [];
            $data["success"] = '200';
            $data["code"] = '200';
            $data["id"] = $send_2->id;
            $data["type"] = "1";
            $data["count"] = "2";
            $result = json_encode($data);
        } else {
            sleep(5);
            $send_3 = json_decode(getid_2($link));
            if ($send_3->code == '200') {
                $data = [];
                $data["success"] = '200';
                $data["code"] = '200';
                $data["id"] = $send_3->id;
                $data["type"] = "1";
                $data["count"] = "3";
                $result = json_encode($data);
            } else {
                $result = getid_1($link);
            }
        }
    }
    return $result;
}
function getid2($link)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.baostar.pro/api/convert-uid',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"type":"follow","link":"' . $link . '"}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = [];
    $data["success"] = '200';
    $data["code"] = '200';
    $data["id"] = $response;
    $result = json_encode($data);
    return $result;
}

function getpost($link)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://hotlike.xyz/api/checklinkfb/check_post/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"id_user":181023,"link":"' . $link . '"}',
        CURLOPT_HTTPHEADER => array(
            'ht-token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTgxMDIzLCJ1c2VybmFtZSI6ImN0dnNhbmciLCJtb25leSI6MTQwODgsInR5cGUiOjAsImNyZWF0ZV9hdCI6IjE2Mzg0NTYxNTEiLCJlbWFpbCI6Im5ndXllbm5nb2N0aGFuaHNhbmcxOTk3QGdtYWlsLmNvbSIsImZhY2Vib29rX2lkIjoiNCIsInBob25lIjoiMDk4Nzc3NzA1OSIsIm5hbWUiOiJ1c2VyIiwicGVyY2VudCI6MCwibm90ZXMiOiJUaMOgbmggdmnDqm4iLCJ1cGRhdGVfYXQiOm51bGwsImRvbWFpbiI6ImhvdGxpa2UueHl6IiwidGllbl9uYXAiOjI3Mjc1MTgsImlhdCI6MTY1OTAwNTc0NCwiZXhwIjoxNjkwNTYyNjcwfQ.wYyxB8gyo0Qm6Ktp4urR36sE2GKyd7AQ2dBTxt770FQ',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
if (isset($_GET['type'])) {
    if ($_GET['type'] == 'like') {
        $link = $_GET['link'];
        echo getid($link);
    } elseif ($_GET['type'] == 'follow') {
        $link = $_GET['link'];
        echo getid2($link);
    }
}
if (isset($_GET['act'])) {
    $link = $_GET['link'];
    echo check_tt($link, 'follow');
}

if (isset($_GET['tiktok']) && $_GET['tiktok'] == 'view') {
    $link = $_GET['link'];
    echo check_tt($link, 'view');
}
if (isset($_GET['post'])) {
    $link = $_GET['link'];
    echo getpost($link);
}
if (isset($_GET['test'])) {
    $link = $_GET['link'];
    echo (getid($link));
}
