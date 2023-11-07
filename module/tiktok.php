<?php
function check_tt($url, $act)
{
    // lấy tất cả nội dung trong url
    // $getlin = get_link($url);
    if ($act == 'view') {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://huaducquan.id.vn/mlike/tiktok.php?url=' . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
        //return $data;
    } elseif ($act == 'follow') {
        // $data = file_get_contents_curl($link, "follow");
        /*
        $quan = [];
        $quan["success"] = "200";
        $quan["id"] = $data->itemInfo->itemStruct->author->id;
        $quan["name"] = $data->itemInfo->itemStruct->author->nickname;
        $quan["nickname"] = "https://www.tiktok.com/@" . $data->itemInfo->itemStruct->author->uniqueId;
        $quan["follow"] = $data->itemInfo->itemStruct->authorStats->followerCount;
        return json_encode($quan);
        */
        //return $data;
    }
}
