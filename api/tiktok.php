<?php

function get_link($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); //set url
    curl_setopt($ch, CURLOPT_HEADER, true); //get header
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Edg/117.0.2045.31');
    curl_setopt($ch, CURLOPT_HEADER, 0); //do not include response body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //do not show in browser the response
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //follow any redirects
    curl_exec($ch);
    $new_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); //extract the url from the header response
    curl_close($ch);
    return $new_url;
}
function file_get_contents_curl($url, $type)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Edg/117.0.2045.31');
    $output = curl_exec($ch);
    curl_close($ch);
    $data = $output;
    $start = preg_quote('<script id="__UNIVERSAL_DATA_FOR_REHYDRATION__" type="application/json">', '/');
    $end = preg_quote('</script>', '/');
    preg_match("/$start(.*?)$end/", $data, $matches);
    $a = $matches[0];
    $quan = ltrim($a, '<script id="__UNIVERSAL_DATA_FOR_REHYDRATION__" type="application/json">');
    $quana = chop($quan, '</script>');
    $en = json_encode($quana);
    $de = json_decode($en);
    $de = json_decode($de, true);
    if ($type == 'view') {
        $get = $de["__DEFAULT_SCOPE__"]["webapp.video-detail"]["itemInfo"]["itemStruct"];
    } elseif ($type == 'user') {
        $get = $de["__DEFAULT_SCOPE__"]["webapp.user-detail"]["userInfo"];
    }
    return json_encode($get);
}
switch ($_GET['type']) {
    case 'video':
        if (isset($_POST['url'])) {
            $pos = strpos($_POST['url'], '@');
            if ($pos == false) {
                $getlin = get_link($_POST['url']);
            } else {
                $getlin = $_POST['url'];
            }
            $getlinkk = explode("/", $getlin);
            $getlink = $getlinkk[5];
            $xoa = explode("?", $getlink);
            $xoa = $xoa[0];
            $user = $getlinkk[3];
            $get = file_get_contents_curl($getlin, 'view');
            $get = json_decode($get, true);
            $info = $get["$xoa"];

            $array = [];
            if (empty($get["author"]["id"])) {
                $array["success"] = '400';
                $array["message"] = 'Không tìm thấy video';
            } else {
                $array["success"] = '200';
                $array["message"] = 'Lấy thông tin thành công';
            }
            $array["data"]["id"] = $get["id"];
            $array["data"]["link"] = $getlin;
            $array["data"]["diggCount"] = $get["stats"]["diggCount"];
            $array["data"]["playCount"] = $get["stats"]["playCount"];
            $array["data"]["shareCount"] = $get["stats"]["shareCount"];
            $array["data"]["commentCount"] = $get["stats"]["commentCount"];
            $array["data"]["collectCount"] = $get["stats"]["collectCount"];
            $array["data"]["video_cover"] = $get["video"]["originCover"];
            $array["data"]["video_createTime"] = $get["createTime"];
            $array["data"]["name"] = $get["author"]["nickname"];
            $array["data"]["user"] = $user;
            $array["data"]["user_cover"] = $get["author"]["avatarLarger"];
            $array["data"]["user_verified"] = $get["author"]["verified"];
            $array["code_by"] = "Hứa Đức Quân - Liên hệ mua api https://www.facebook.com/quancp72h";
            echo json_encode($array);
        } else {
            $array = [];
            $array["success"] = '400';
            $array["message"] = 'Vui lòng nhập url';
            $array["code_by"] = "Hứa Đức Quân - Liên hệ mua api https://www.facebook.com/quancp72h";
            echo json_encode($array);
        }
        break;
    case 'user':
        if (isset($_POST['url'])) {
            $get_user = $_POST['url'];
            $get = file_get_contents_curl($get_user, 'user');
            $get = json_decode($get, true);
            $array = [];
            if (empty($get["user"]["id"])) {
                $array["success"] = '400';
                $array["message"] = 'Không tìm thấy user';
            } else {
                $array["success"] = '200';
                $array["message"] = 'Lấy thông tin thành công';
            }
            $array["data"]["id"] = $get["user"]["id"];
            $array["data"]["name"] = $get["user"]["nickname"];
            $array["data"]["user"] = $get["user"]["uniqueId"];
            $array["data"]["user_cover"] = $get["user"]["avatarLarger"];
            $array["data"]["user_verified"] = $get["user"]["verified"];
            $array["data"]["privateAccount"] = $get["user"]["privateAccount"];
            $array["data"]["region"] = $get["user"]["region"];
            $array["data"]["user_follower"] = $get["stats"]["followerCount"];
            $array["data"]["user_following"] = $get["stats"]["followingCount"];
            $array["data"]["user_heart"] = $get["stats"]["heartCount"];
            $array["data"]["user_video"] = $get["stats"]["videoCount"];
            $array["data"]["friendCount"] = $get["stats"]["friendCount"];
            $array["code_by"] = "Hứa Đức Quân - Liên hệ mua api https://www.facebook.com/quancp72h";
            echo json_encode($array);
        } else {
            $array = [];
            $array["success"] = '400';
            $array["message"] = 'Vui lòng nhập url';
            $array["code_by"] = "Hứa Đức Quân - Liên hệ mua api https://www.facebook.com/quancp72h";
            echo json_encode($array);
        }
        break;
}
