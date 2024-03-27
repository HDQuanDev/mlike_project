<?php

$db = mysqli_connect('localhost', 'admin_data', 'PIpOBoXJSJ', 'admin_data');
function getUserAgent()
{
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0.1 Safari/604.3.5";
    $userAgentArray[] = "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.89 Safari/537.36 OPR/49.0.2725.47";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/604.4.7 (KHTML, like Gecko) Version/11.0.2 Safari/604.4.7";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36 Edge/15.15063";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36 Edge/16.16299";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/604.4.7 (KHTML, like Gecko) Version/11.0.2 Safari/604.4.7";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0.1 Safari/604.3.5";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:52.0) Gecko/20100101 Firefox/52.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36 OPR/49.0.2725.64";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/604.4.7 (KHTML, like Gecko) Version/11.0.2 Safari/604.4.7";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/62.0.3202.94 Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0";
    $userAgentArray[] = "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0;  Trident/5.0)";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; rv:52.0) Gecko/20100101 Firefox/52.0";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/63.0.3239.84 Chrome/63.0.3239.84 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.89 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0; Trident/5.0;  Trident/5.0)";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0.1 Safari/604.3.5";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:57.0) Gecko/20100101 Firefox/57.0";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0";
    $userAgentArray[] = "Mozilla/5.0 (iPad; CPU OS 11_1_2 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0 Mobile/15B202 Safari/604.1";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.13; rv:58.0) Gecko/20100101 Firefox/58.0";
    $userAgentArray[] = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Safari/604.1.38";
    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
    $userAgentArray[] = "Mozilla/5.0 (X11; CrOS x86_64 9901.77.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.97 Safari/537.36";
    $getArrayKey = array_rand($userAgentArray);
    return $userAgentArray[$getArrayKey];
}
$cookie = 'quanne.txt';
$uge = getUserAgent();
function login($user, $pass)
{
    global $cookie, $uge;
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://traodoisub.com/scr/login.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => "username=$user&password=$pass",
    CURLOPT_HTTPHEADER => ["content-type: application/x-www-form-urlencoded", "origin: https://traodoisub.com", "user-agent: $uge",],
    CURLOPT_COOKIEJAR => $cookie,
    CURLOPT_COOKIEFILE => $cookie,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
function checkxu()
{
    global $cookie, $uge;
    $curl = curl_init();
    curl_setopt_array($curl, [CURLOPT_URL => "https://traodoisub.com/scr/user.php", CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_COOKIEJAR => $cookie, CURLOPT_COOKIEFILE => $cookie, CURLOPT_HTTPHEADER => ["content-type: application/x-www-form-urlencoded", "origin: https://traodoisub.com", "user-agent: $uge",],]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $su = json_decode($response);
    $tien = $su->xu;
    return $tien;
}
function mua($id, $sl, $t)
{
    global $cookie, $uge;
    $curl = curl_init();
    curl_setopt_array($curl, [CURLOPT_URL => "https://traodoisub.com/mua/likegiare/themid.php", CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '', CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "POST", CURLOPT_POSTFIELDS => "maghinho=buyofproxy&id=$id&sl=$sl&is_album=not&speed=1&dateTime=$t", CURLOPT_COOKIEJAR => $cookie, CURLOPT_COOKIEFILE => $cookie, CURLOPT_HTTPHEADER => ["content-type: application/x-www-form-urlencoded", "origin: https://traodoisub.com", "user-agent: $uge",],]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}
function send_limit_tds($user, $pass, $idpost, $limit)
{
    global $cookie;
    $date_create = date("Y-m-d H:i:s");
    $login_tds = json_decode(login($user, $pass));
    var_dump($login_tds);
    if ($login_tds->success == 'true') {
        $tien = checkxu();
        if ($tien >= 6800) {
            $arr = array();
            $tongxu = $limit * 200;
            $tonglike = $tien / 200;
            $tonglike = floor($tonglike);
            if ($tien < $tongxu) {
                $mua = $tonglike;
            } elseif ($tien > $tongxu) {
                $mua = $limit;
            }
            $send = mua("$idpost", "$mua", "$date_create");
            if (strpos($send, 'nh công') !== false) {
                $arr["status"] = "success";
                $arr["code"] = "100";
                $arr["damua"] = $mua;
                $arr["acc"] = $user;
                $arr["msg"] = "Mua thanh cong";
                $arr["total"] = $tongxu;
            } elseif (strpos($send, 'iới hạn') !== false) {
                $arr["status"] = "error";
                $arr["code"] = "111";
                $arr["msg"] = 'Gioi han acc';
                $arr["acc"] = $user;
            } elseif (strpos($send, 'spam') !== false) {
                $arr["status"] = "error";
                $arr["code"] = "112";
                $arr["msg"] = 'mua bi spam';
                $arr["acc"] = $user;
            } elseif ($send == 1) {
                $arr["status"] = "error";
                $arr["code"] = "113";
                $arr["msg"] = $send;
                $arr["acc"] = $user;
            } elseif (strpos($send, 'Tiền') !== false) {
                $arr["status"] = "error";
                $arr["code"] = "114";
                $arr["msg"] = 'Khong du tien trong acc';
                $arr["acc"] = $user;
            } elseif (strpos($send, '0') !== false) {
                $arr["status"] = "error";
                $arr["code"] = "115";
                $arr["msg"] = 'Login khong thanh cong';
                $arr["acc"] = $user;
            } else {
                $arr["status"] = "error";
                $arr["code"] = "222";
                $arr["acc"] = $user;
                $arr["msg"] = $send;
                $arr["idpost"] = $idpost;
            }
        } else {
            $arr["status"] = "error";
            $arr["code"] = "200";
            $arr["msg"] = "khong du tien 1";
        }
    } else {
        $arr["status"] = "error";
        $arr["code"] = "300";
        $arr["msg"] = "khong login duoc";
    }
    unlink($cookie);
    return json_encode($arr);
}
function get_limit($act, $tongxu, $userr)
{
    global $db;
    $ac = mysqli_query($db, "SELECT * FROM `acctds` WHERE `tien` > '7600' ORDER BY RAND() LIMIT 1");
    $cacc = mysqli_num_rows($ac);
    if ($cacc > 0) {
        $acc = mysqli_fetch_assoc($ac);
        $user = $acc['user'];
        $pass = $acc['pass'];
        $tien = trim($acc['tien']);
        $proxy = $acc['proxy'];
        $proxyauth = $acc['proxyauth'];
        if ($act == 'user') {
            $result = $user;
        } elseif ($act == 'pass') {
            $result = $pass;
        } elseif ($act == 'proxy') {
            $result = $proxy;
        } elseif ($act == 'proxypass') {
            $result = $proxyauth;
        } elseif ($act == 'updatexu') {
            $xu = $tongxu;
            mysqli_query($db, "UPDATE `acctds` SET `tien` = `tien`-'$xu', `slsd` = `slsd`+'1' WHERE `user` = '$userr'");
            $result = 'ok';
        }
        return $result;
    } else {
        return 'error';
    }
}
if ($_GET['act'] == '2') {
    $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '1' AND `sttdone` = '0' AND `iddon` = '2005' AND `bh` = '19' ORDER BY `id` DESC");
    $ro = mysqli_fetch_assoc($result1);
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if (isset($ro)) {
        $idpost = $ro['profile'];
        $id = $ro['id'];
        $sl = $ro['sl'];
        $done = $ro['done'];
        $limit = ($sl - $done);
        $code = $ro['code'];
        if ($ro['sttdone'] == '0') {
            if ($limit > '19') {
                if ($limit >= '20') {
                    $acc = get_limit('user', '0', '0');
                    $pass = get_limit('pass', '0', '0');
                    $proxy = get_limit('proxy', '0', '0');
                    $proxypass = get_limit('proxypass', '0', '0');
                    $quan = send_limit_tds($acc, $pass, $idpost, $limit);
                    $hi = json_decode($quan);
                    if ($hi->code == '100') {
                        $damu = $hi->damua;
                        $damua = $damu + $done;
                        $goc = $sl - 20;
                        if ($damua >= $goc) {
                            $trangthai = '2';
                            $stt = '1';
                        } else {
                            $trangthai = '3';
                            $stt = '0';
                        }
                        $tongxu = $hi->tongxu;
                        mysqli_query($db, "UPDATE `dichvu` SET `done` = '$damua',`trangthai` = '$trangthai', `sttdone` = '$stt' WHERE `code` = '$code'");
                        echo get_limit('updatexu', '' . $tongxu . '', '' . $acc . '');
                    } elseif ($hi->code == '222') {
                        mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '4', `done` = '0', `sttdone` = '1' WHERE `code` = '$code'");
                    }
                } else {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `code` = '$code'");
                }
            }
        }
        $fp = @fopen('log.txt', "a+");
        $data = 'IP: ' . $ip . ' -> ' . $hi->msg . ' [(ID: ' . $id . ') ' . $idpost . ' -> ' . $hi->damua . '] [' . $acc . ']
            ';
        fwrite($fp, $data);
    } else {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $fp = @fopen('log.txt', "a+");
        $data = 'IP: ' . $ip . ' -> loi truyen du lieu
            ';
        fwrite($fp, $data);
        print('Khong du phan tu');
    }
} elseif ($_GET['act'] == '1') {
    $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '7' AND `sttdone` = '0' AND `time` >= '1637059909' ORDER BY `id` DESC");
    $ro = mysqli_fetch_assoc($result1);
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if (isset($ro)) {
        $idpost = $ro['profile'];
        $id = $ro['id'];
        $sl = $ro['sl'];
        $done = $ro['done'];
        $limit = ($sl - $done);
        $code = $ro['code'];
        if ($ro['sttdone'] == '0') {
            if ($limit > '19') {
                if ($limit >= '20') {
                    $acc = get_limit('user', '0', '0');
                    $pass = get_limit('pass', '0', '0');
                    $proxy = get_limit('proxy', '0', '0');
                    $proxypass = get_limit('proxypass', '0', '0');
                    $quan = send_limit_tds($acc, $pass, $idpost, $limit);
                    $hi = json_decode($quan);
                    if ($hi->code == '100') {
                        $damu = $hi->damua;
                        $damua = $damu + $done;
                        $goc = $sl - 20;
                        if ($damua >= $goc) {
                            $trangthai = '2';
                            $stt = '1';
                        } else {
                            $trangthai = '3';
                            $stt = '0';
                        }
                        $tongxu = $hi->tongxu;
                        mysqli_query($db, "UPDATE `dichvu` SET `done` = '$damua',`trangthai` = '$trangthai', `sttdone` = '$stt' WHERE `code` = '$code'");
                        echo get_limit('updatexu', '' . $tongxu . '', '' . $acc . '');
                    } elseif ($hi->code == '222') {
                        mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '4', `done` = '0', `sttdone` = '1' WHERE `code` = '$code'");
                    }
                } else {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `code` = '$code'");
                }
            }
        }
        $fp = @fopen('log.txt', "a+");
        $data = 'IP: ' . $ip . ' -> ' . $hi->msg . ' [(ID: ' . $id . ') ' . $idpost . ' -> ' . $hi->damua . '] [' . $acc . ']
            ';
        fwrite($fp, $data);
    } else {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $fp = @fopen('log.txt', "a+");
        $data = 'IP: ' . $ip . ' -> loi truyen du lieu
            ';
        fwrite($fp, $data);
        print('Khong du phan tu');
    }
}

switch ($_GET['quan']) {
    case '1':
        $code = rand();
        header('location: /run.php?act=1&code=' . $code);
        break;
    case '2':
        $code = rand();
        header('location: /run.php?act=2&code=' . $code);
        break;
    case 'log':
        $code = rand();
        header('location: /log.txt?code=' . $code);
        break;
    case 'dellog':
        unlink('log.txt');
        break;
}
