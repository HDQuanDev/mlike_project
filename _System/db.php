<?php
//error_reporting(0);
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('_PHPVERSION_', '7.4');
define('_PHPRUN_', phpversion());
define('_SITE_', 'https://mlike.vn');
// initializing variables
$login = $_SESSION['u'];
require_once('config.php');
require_once('function.php');
//require_once('../module/email.php');
//config tiktok
$stttiktok = 'off';
// connect to the database
$db = mysqli_connect('localhost', 'mlike', 'WEJajXeMBHPeeWbt', 'mlike');
if (!$db) {
    echo '{"status":"error","message":"Không thể kết nối đến CSDL/không tìm thấy CSDL","error_code": "' . mysqli_connect_errno() . '"}';
    exit;
}
mysqli_set_charset($db, "utf8");
$urll = $_SERVER['SCRIPT_NAME'];
$site = $_SERVER['HTTP_HOST'];
$domain = 'https://' . $site . '';
if ($site == 'like1s.vn') {
    $site = 'mlike.vn';
    $domain = 'https://like1s.vn';
}
if ($site == 'api.like1s.vn') {
    $site = 'mlike.vn';
    $domain = 'https://api.like1s.vn';
}
if ($site == 'localhost') {
    $site = 'mlike.vn';
    $domain = 'http://localhost';
}
$url = 'https://' . $site . '' . $urll . '';
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $cdn = 'http://localhost/assets';
}
$cdn = 'https://mlike.vn/assets';

$s = mysqli_query($db, "SELECT * FROM `system`");
$s = mysqli_fetch_assoc($s);
if (isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {
    session_destroy();
    setcookie("user", "", time() - 31556926, "/");
    setcookie("pass", "", time() - 31556926, "/");
    header('location:/');
}
if ($login) {
    $tko = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$login' AND `site` = '$site'");
    $tko = mysqli_num_rows($tko);
    if ($tko == 0) {
        session_destroy();
        setcookie("username", "", time() - 31556926, "/");
        setcookie("password", "", time() - 31556926, "/");
        header('location:/');
    }


    $result1 = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$login' ORDER BY id DESC");
    while ($ro = mysqli_fetch_assoc($result1)) {
        if ($ro['token'] == 'quan') {
            $id = $ro['id'];
            $mgt = $ro['mgt'];
            $token = base64_encode(serialize(md5($id . $mgt)));
            mysqli_query($db, "UPDATE `member` SET `token` = '$token'
    WHERE `username` = '$login' AND `site` = '$site'");
        }
    }
    $result = mysqli_query($db, "SELECT * FROM `member` WHERE `username` = '$login' AND `site` = '$site'");
    $row = mysqli_fetch_assoc($result);


    if ($row['rule'] == 99) {
        $cv = "Admin!";
    } elseif ($row['rule'] == 33) {
        $cv = "Cộng Tác Viên";
    } elseif ($row['rule'] == 66) {
        $cv = "Đại Lý";
    } else {
        $cv = "Thành Viên";
    }
    if ($row['rule'] == 10) {
        header('location:/500');
    }
}
if (isset($login) || isset($_POST['token'])) {
    if (isset($login)) {
        $sg = mysqli_query($db, "SELECT * FROM `setgia` WHERE `user` = '" . $_SESSION['u'] . "' AND `site` = '$site'");
        $sg = mysqli_num_rows($sg);
        $logi = $login;
        if (!isset($_COOKIE["token"])) {
            setcookie("token", $row["token"], time() + 31556926, "/");
        }
        if (!isset($_COOKIE["cv"])) {
            setcookie("cv", $row["rule"], time() + 31556926, "/");
        }
    } elseif (isset($_POST['token'])) {
        $token = mysqli_real_escape_string($db, $_POST['token']);
        $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
        $tko = mysqli_num_rows($uu);
        if ($tko == '1') {
            $row = mysqli_fetch_assoc($uu);
            $logi = $row['username'];
            $sg = mysqli_query($db, "SELECT * FROM `setgia` WHERE `user` = '" . $logi . "' AND `site` = '$site'");
            $sg = mysqli_num_rows($sg);
        } else {
            echo '{"status":"error","msg":"Lỗi hệ thống api!"}';
            exit();
        }
    }
    if (isset($page)) {
        if ($sg == 1) {
            $get = mysqli_query($db, "SELECT * FROM `setgia` WHERE `user` = '" . $logi . "' AND `site` = '$site'");
            $q = mysqli_fetch_assoc($get);
            if ($page == 'like_fb') { //Like Facebook
                $gia1 = $q['fbl_1'];
                $gia2 = $q['fbl_2'];
                $gia3 = $q['fbl_3'];
                $gia4 = $q['fbl_4'];
                $gia5 = $q['fbl_5'];
                $gia6 = $q['fbl_6'];
                $gia7 = $q['fbl_7'];
                $gia8 = $q['fbl_8'];
                $gia9 = $q['fbl_9'];
                $gia10 = $q['fbl_10'];
                $gia11 = $q['fbl_11'];
                $gia12 = $q['fbl_12'];
                $info = $if->data->facebook->like_1;
            }
            if ($page == 'like_fb_v2') { //Like Facebook V2
                $gia1 = $q['fblv2_1'];
                $gia2 = $q['fblv2_2'];
                $gia3 = $q['fblv2_3'];
                $gia4 = $q['fblv2_4'];
                $info = $if->data->facebook->like_1;
            } elseif ($page == 'fb_feeling') {
                $gia1 = $q['fbcx_1'];
                $gia2 = $q['fbcx_2'];
            } elseif ($page == 'fb_likecmt') {
                $gia1 = $q['fblikecmt_1'];
                $gia2 = $q['fblikecmt_2'];
                $gia3 = $q['fblikecmt_3'];
            } elseif ($page == 'cmt_fb') {
                $gia1 = $q['fbcmt_1'];
                $gia2 = $q['fbcmt_2'];
            } elseif ($page == 'share_fb') {
                $gia1 = $q['fbshare_1'];
                $gia2 = $q['fbshare_2'];
                $gia3 = $q['fbshare_3'];
                $gia4 = $q['fbshare_4'];
                $gia5 = $q['fbshare_5'];
            } elseif ($page == 'follow_fb') {
                $gia1 = $q['fbfollow_1'];
                $gia2 = $q['fbfollow_2'];
                $gia3 = $q['fbfollow_3'];
                $gia4 = $q['fbfollow_4'];
                $gia5 = $q['fbfollow_5'];
                $gia6 = $q['fbfollow_6'];
                $gia7 = $q['fbfollow_7'];
                $gia8 = $q['fbfollow_8'];
                $gia9 = $q['fbfollow_9'];
                $gia10 = $q['fbfollow_10'];
            } elseif ($page == 'live_fb') {
                $gia1 = $q['fblive_1'];
                $gia2 = $q['fblive_2'];
                $gia3 = $q['fblive_3'];
                $gia4 = $q['fblive_4'];
                $gia5 = $q['fblive_5'];
                $gia6 = $q['fblive_6'];
                $gia7 = $q['fblive_7'];
                $gia8 = $q['fblive_8'];
                $gia9 = $q['fblive_9'];
                $gia10 = $q['fblive_10'];
                $gia11 = $q['fblive_11'];
            } elseif ($page == 'live_fb_v2') {
                $gia1 = $q['fblivev2_1'];
                $gia2 = $q['fblivev2_2'];
                $gia3 = $q['fblivev2_3'];
            } elseif ($page == 'page_fb') {
                $gia1 = $q['fbpage_1'];
                $gia2 = $q['fbpage_2'];
            } elseif ($page == 'group_fb') {
                $gia1 = $q['fbgroup_1'];
                $gia2 = $q['fbgroup_2'];
                $gia3 = $q['fbgroup_3'];
                $gia4 = $q['fbgroup_4'];
            } elseif ($page == 'view_fb') {
                $gia1 = $q['fbview_1'];
                $gia2 = $q['fbview_2'];
                $gia3 = $q['fbview_3'];
                $gia4 = $q['fbview_4'];
                $gia5 = $q['fbview_5'];
                $gia6 = $q['fbview_6'];
                $gia7 = $q['fbview_7'];
            } elseif ($page == 'viplike_fb') {
                $gia1 = $q['fbviplike_1'];
            } elseif ($page == 'view_story') {
                $gia1 = $q['fbstory_1'];
            } elseif ($page == 'like_ig') {
                $gia1 = $q['iglike_1'];
                $gia2 = $q['iglike_2'];
                $gia3 = $q['iglike_3'];
            } elseif ($page == 'follow_ig') {
                $gia1 = $q['igfollow_1'];
                $gia2 = $q['igfollow_2'];
                $gia3 = $q['igfollow_3'];
            } elseif ($page == 'view_ig') {
                $gia1 = $q['igview_1'];
                $gia2 = $q['igview_2'];
            } elseif ($page == 'cmt_ig') {
                $gia1 = $q['igcmt_1'];
            } elseif ($page == 'view_tt') {
                $gia1 = $q['ttview_1'];
                $gia2 = $q['ttview_2'];
                $gia3 = $q['ttview_3'];
                $gia4 = $q['ttview_4'];
                $gia5 = $q['ttview_5'];
                $gia6 = $q['ttview_6'];
                $gia7 = $q['ttview_7'];
                $gia8 = $q['ttview_8'];
            } elseif ($page == 'tim_tt') {
                $gia1 = $q['ttlike_1'];
                $gia2 = $q['ttlike_2'];
                $gia3 = $q['ttlike_3'];
                $gia4 = $q['ttlike_4'];
                $gia5 = $q['ttlike_5'];
                $gia6 = $q['ttlike_6'];
                $gia7 = $q['ttlike_7'];
                $gia8 = $q['ttlike_8'];
            } elseif ($page == 'tim_tt_tay') {
                $gia1 = $q['ttliketay_1'];
            } elseif ($page == 'follow_tt') {
                $gia1 = $q['ttfollow_1'];
                $gia2 = $q['ttfollow_2'];
                $gia3 = $q['ttfollow_3'];
                $gia4 = $q['ttfollow_4'];
                $gia5 = $q['ttfollow_5'];
            } elseif ($page == 'live_tt') {
                $gia1 = $q['ttlive_1'];
            } elseif ($page == 'cmt_tt') {
                $gia1 = $q['ttcmt_1'];
            } elseif ($page == 'save_tt') {
                $gia1 = $q['ttsave_1'];
            } elseif ($page == 'share_tt') {
                $gia1 = $q['ttshare_1'];
            } elseif ($page == 'view_web') {
                $gia1 = $q['otweb_1'];
            } elseif ($page == 'sub_ytb') {
                $gia1 = $q['ytbsub_1'];
                $gia2 = $q['ytbsub_2'];
            } elseif ($page == 'view_ytb') {
                $gia1 = $q['ytbview_1'];
                $gia2 = $q['ytbview_2'];
                $gia3 = $q['ytbview_3'];
            } elseif ($page == 'like_ytb') {
                $gia1 = $q['ytblike_1'];
            }
        } else {
            if ($row['rule'] == 66) { // bắt đầu set giá đại lý
                if ($page == 'like_fb') { //Like Facebook
                    // Giá Đại Lý
                    $gia1 = 6.5; //Server 1
                    $gia2 = 10.5; // 2
                    $gia3 = 18; // 3
                    $gia4 = 3.2; // 4
                    $gia5 = 20; // 5
                    $gia6 = 5; // 5
                    $gia7 = 5.3;
                    $gia8 = 6.3;
                    $gia9 = 4.9;
                    $gia10 = 6;
                    $gia11 = 5.1;
                    $gia12 = 7;
                } elseif ($page == 'like_fb_v2') { //Like Facebook V2
                    $gia1 = 4;
                    $gia2 = 6;
                    $gia3 = 8;
                    $gia4 = 10;
                } elseif ($page == 'fb_feeling') {
                    $gia1 = 9.9;
                    $gia2 = 8;
                } elseif ($page == 'fb_likecmt') {
                    $gia1 = 18;
                    $gia2 = 22;
                    $gia3 = 17;
                } elseif ($page == 'cmt_fb') {
                    $gia1 = 100;
                    $gia2 = 200;
                } elseif ($page == 'share_fb') {
                    $gia1 = 40;
                    $gia2 = 6.5;
                    $gia3 = 300;
                    $gia4 = 0.2;
                    $gia5 = 1;
                } elseif ($page == 'follow_fb') {
                    $gia1 = 19;
                    $gia2 = 22;
                    $gia3 = 23;
                    $gia4 = 17;
                    $gia5 = 7;
                    $gia6 = 20;
                    $gia7 = 99;
                    $gia8 = 23;
                    $gia9 = 17;
                    $gia10 = 15;
                } elseif ($page == 'live_fb') {
                    $gia1 = 1.5;
                    $gia2 = 0.7;
                    $gia3 = 1.2;
                    $gia4 = 0.8;
                    $gia5 = 1.9;
                    $gia6 = 1.9;
                    $gia7 = 3;
                    $gia8 = 3.5;
                    $gia9 = 4;
                    $gia10 = 4;
                    $gia11 = 4;
                } elseif ($page == 'live_fb_v2') {
                    $gia1 = 2;
                    $gia2 = 5;
                    $gia3 = 4;
                } elseif ($page == 'page_fb') {
                    $gia1 = 45;
                    $gia2 = 45;
                } elseif ($page == 'group_fb') {
                    $gia1 = 50;
                    $gia2 = 40;
                    $gia3 = 30;
                    $gia4 = 25;
                } elseif ($page == 'view_fb') {
                    $gia1 = 20;
                    $gia2 = 7;
                    $gia3 = 13;
                    $gia4 = 19;
                    $gia5 = 2;
                    $gia6 = 0.27;
                    $gia7 = 1.2;
                } elseif ($page == 'viplike_fb') {
                    $gia1 = 35;
                } elseif ($page == 'view_story') {
                    $gia1 = 8;
                } elseif ($page == 'like_ig') {
                    $gia1 = 47;
                    $gia2 = 15;
                    $gia3 = 13;
                } elseif ($page == 'follow_ig') {
                    $gia1 = 92;
                    $gia2 = 25;
                    $gia3 = 20;
                } elseif ($page == 'view_ig') {
                    $gia1 = 10;
                    $gia2 = 2;
                } elseif ($page == 'cmt_ig') {
                    $gia1 = 99;
                } elseif ($page == 'view_tt') {
                    $gia1 = 0.085;
                    $gia2 = 0.035;
                    $gia3 = 0.025;
                    $gia4 = 0.49;
                    $gia5 = 0.13;
                    $gia6 = 0.079;
                    $gia7 = 0.345;
                    $gia8 = 0.0456;
                } elseif ($page == 'tim_tt') {
                    $gia1 = 15;
                    $gia2 = 17;
                    $gia3 = 20;
                    $gia4 = 12;
                    $gia5 = 13;
                    $gia6 = 9;
                    $gia7 = 11;
                    $gia8 = 11;
                } elseif ($page == 'tim_tt_tay') {
                    $gia1 = 1.8;
                } elseif ($page == 'follow_tt') {
                    $gia1 = 47;
                    $gia2 = 60;
                    $gia3 = 25;
                    $gia4 = 40;
                    $gia5 = 20;
                } elseif ($page == 'live_tt') {
                    $gia1 = 15;
                } elseif ($page == 'cmt_tt') {
                    $gia1 = 50;
                } elseif ($page == 'save_tt') {
                    $gia1 = 10;
                } elseif ($page == 'share_tt') {
                    $gia1 = 8;
                } elseif ($page == 'view_web') {
                    $gia1 = 20;
                } elseif ($page == 'sub_ytb') {
                    $gia1 = 350;
                    $gia2 = 720;
                } elseif ($page == 'view_ytb') {
                    $gia1 = 42;
                    $gia2 = 45;
                    $gia3 = 65;
                } elseif ($page == 'like_ytb') {
                    $gia1 = 70;
                }
                // kết khúc set giá dại lý
            } else if ($row['rule'] == 33) { // bắt đầu sét giá cộng tác viên
                if ($page == 'like_fb') { //Like Facebook
                    $gia1 = 6.5; //Server 1
                    $gia2 = 11; // 2
                    $gia3 = 18; // 3
                    $gia4 = 3.2; // 4
                    $gia5 = 21; // 5
                    $gia6 = 4.5; // 5
                    $gia7 = 5.8;
                    $gia8 = 6.4;
                    $gia9 = 4.9;
                    $gia10 = 6;
                    $gia11 = 5.1;
                    $gia12 = 7;
                } elseif ($page == 'like_fb_v2') { //Like Facebook V2
                    $gia1 = 4.5;
                    $gia2 = 6.5;
                    $gia3 = 8.5;
                    $gia4 = 10.5;
                } elseif ($page == 'fb_feeling') {
                    $gia1 = 11;
                    $gia2 = 9;
                } elseif ($page == 'fb_likecmt') {
                    $gia1 = 18;
                    $gia2 = 22;
                    $gia3 = 17;
                } elseif ($page == 'cmt_fb') {
                    $gia1 = 110;
                    $gia2 = 250;
                } elseif ($page == 'share_fb') {
                    $gia1 = 60;
                    $gia2 = 7;
                    $gia3 = 400;
                    $gia4 = 0.2;
                    $gia5 = 1;
                } elseif ($page == 'follow_fb') {
                    $gia1 = 19;
                    $gia2 = 22;
                    $gia3 = 23;
                    $gia4 = 17;
                    $gia5 = 7;
                    $gia6 = 20;
                    $gia7 = 99;
                    $gia8 = 23;
                    $gia9 = 17;
                    $gia10 = 15;
                } elseif ($page == 'live_fb') {
                    $gia1 = 1.6;
                    $gia2 = 0.8;
                    $gia3 = 1.3;
                    $gia4 = 0.9;
                    $gia5 = 2;
                    $gia6 = 2;
                    $gia7 = 3;
                    $gia8 = 3.5;
                    $gia9 = 4;
                    $gia10 = 4;
                    $gia11 = 4;
                } elseif ($page == 'live_fb_v2') {
                    $gia1 = 3;
                    $gia2 = 5;
                    $gia3 = 4;
                } elseif ($page == 'page_fb') {
                    $gia1 = 45;
                    $gia2 = 45;
                } elseif ($page == 'group_fb') {
                    $gia1 = 50;
                    $gia2 = 40;
                    $gia3 = 30;
                    $gia4 = 25;
                } elseif ($page == 'view_fb') {
                    $gia1 = 20;
                    $gia2 = 8;
                    $gia3 = 13.5;
                    $gia4 = 19;
                    $gia5 = 2;
                    $gia6 = 0.27;
                    $gia7 = 1.2;
                } elseif ($page == 'viplike_fb') {
                    $gia1 = 35;
                } elseif ($page == 'view_story') {
                    $gia1 = 10;
                } elseif ($page == 'like_ig') {
                    $gia1 = 47;
                    $gia2 = 15;
                    $gia3 = 13;
                } elseif ($page == 'follow_ig') {
                    $gia1 = 92;
                    $gia2 = 25;
                    $gia3 = 20;
                } elseif ($page == 'view_ig') {
                    $gia1 = 10;
                    $gia2 = 2;
                } elseif ($page == 'cmt_ig') {
                    $gia1 = 330;
                } elseif ($page == 'view_tt') {
                    $gia1 = 0.085;
                    $gia2 = 0.035;
                    $gia3 = 0.025;
                    $gia4 = 0.49;
                    $gia5 = 0.13;
                    $gia6 = 0.79;
                    $gia7 = 0.345;
                    $gia8 = 0.0456;
                } elseif ($page == 'tim_tt') {
                    $gia1 = 16;
                    $gia2 = 19;
                    $gia3 = 21;
                    $gia4 = 12;
                    $gia5 = 14;
                    $gia6 = 10;
                    $gia7 = 11;
                    $gia8 = 8;
                } elseif ($page == 'tim_tt_tay') {
                    $gia1 = 1.8;
                } elseif ($page == 'follow_tt') {
                    $gia1 = 47;
                    $gia2 = 60;
                    $gia3 = 28;
                    $gia4 = 40;
                    $gia5 = 20;
                } elseif ($page == 'live_tt') {
                    $gia1 = 15;
                } elseif ($page == 'cmt_tt') {
                    $gia1 = 80;
                } elseif ($page == 'save_tt') {
                    $gia1 = 10;
                } elseif ($page == 'share_tt') {
                    $gia1 = 10;
                } elseif ($page == 'view_web') {
                    $gia1 = 20;
                } elseif ($page == 'sub_ytb') {
                    $gia1 = 600;
                    $gia2 = 750;
                } elseif ($page == 'view_ytb') {
                    $gia1 = 42;
                    $gia2 = 45;
                    $gia3 = 65;
                } elseif ($page == 'like_ytb') {
                    $gia1 = 70;
                }
                //kết thúc set giá ctv    
            } else { // bắt đầu set giá thành viên
                if ($page == 'like_fb') { //Like Facebook
                    $gia1 = 6.5; //Server 1
                    $gia2 = 11; // 2
                    $gia3 = 18; // 3
                    $gia4 = 3.2; // 4
                    $gia5 = 22; // 5
                    $gia6 = 5; // 5
                    $gia7 = 5.4;
                    $gia8 = 6.4;
                    $gia9 = 4.9;
                    $gia10 = 6;
                    $gia11 = 5.1;
                    $gia12 = 7;
                } elseif ($page == 'like_fb_v2') { //Like Facebook V2
                    $gia1 = 5;
                    $gia2 = 7;
                    $gia3 = 9;
                    $gia4 = 12;
                } elseif ($page == 'fb_feeling') {
                    $gia1 = 10;
                    $gia2 = 8;
                } elseif ($page == 'fb_likecmt') {
                    $gia1 = 18;
                    $gia2 = 22;
                    $gia3 = 17;
                } elseif ($page == 'cmt_fb') {
                    $gia1 = 115;
                    $gia2 = 300;
                } elseif ($page == 'share_fb') {
                    $gia1 = 40;
                    $gia2 = 7;
                    $gia3 = 400;
                    $gia4 = 0.2;
                    $gia5 = 1;
                } elseif ($page == 'follow_fb') {
                    $gia1 = 19;
                    $gia2 = 22;
                    $gia3 = 23;
                    $gia4 = 7;
                    $gia5 = 7;
                    $gia6 = 20;
                    $gia7 = 99;
                    $gia8 = 23;
                    $gia9 = 17;
                    $gia10 = 15;
                } elseif ($page == 'live_fb') {
                    $gia1 = 1.5;
                    $gia2 = 0.7;
                    $gia3 = 1.2;
                    $gia4 = 0.8;
                    $gia5 = 2;
                    $gia6 = 2;
                    $gia7 = 3;
                    $gia8 = 3.5;
                    $gia9 = 4;
                    $gia10 = 4;
                    $gia11 = 4;
                } elseif ($page == 'live_fb_v2') {
                    $gia1 = 2;
                    $gia2 = 5;
                    $gia3 = 4;
                } elseif ($page == 'page_fb') {
                    $gia1 = 45;
                    $gia2 = 45;
                } elseif ($page == 'group_fb') {
                    $gia1 = 50;
                    $gia2 = 40;
                    $gia3 = 30;
                    $gia4 = 25;
                } elseif ($page == 'view_fb') {
                    $gia1 = 20;
                    $gia2 = 8;
                    $gia3 = 14;
                    $gia4 = 19;
                    $gia5 = 2;
                    $gia6 = 0.27;
                    $gia7 = 1.2;
                } elseif ($page == 'viplike_fb') {
                    $gia1 = 35;
                } elseif ($page == 'view_story') {
                    $gia1 = 9;
                } elseif ($page == 'like_ig') {
                    $gia1 = 47;
                    $gia2 = 15;
                    $gia3 = 13;
                } elseif ($page == 'follow_ig') {
                    $gia1 = 92;
                    $gia2 = 25;
                    $gia3 = 20;
                } elseif ($page == 'view_ig') {
                    $gia1 = 10;
                    $gia2 = 2;
                } elseif ($page == 'cmt_ig') {
                    $gia1 = 100;
                } elseif ($page == 'view_tt') {
                    $gia1 = 0.085;
                    $gia2 = 0.035;
                    $gia3 = 0.025;
                    $gia4 = 0.49;
                    $gia5 = 0.13;
                    $gia6 = 0.079;
                    $gia7 = 0.345;
                    $gia8 = 0.0456;
                } elseif ($page == 'tim_tt') {
                    $gia1 = 16;
                    $gia2 = 19;
                    $gia3 = 22;
                    $gia4 = 13;
                    $gia5 = 14;
                    $gia6 = 10;
                    $gia7 = 11;
                    $gia8 = 8;
                } elseif ($page == 'tim_tt_tay') {
                    $gia1 = 1.8;
                } elseif ($page == 'follow_tt') {
                    $gia1 = 47;
                    $gia2 = 60;
                    $gia3 = 30;
                    $gia4 = 40;
                    $gia5 = 20;
                } elseif ($page == 'live_tt') {
                    $gia1 = 15;
                } elseif ($page == 'cmt_tt') {
                    $gia1 = 100;
                } elseif ($page == 'save_tt') {
                    $gia1 = 10;
                } elseif ($page == 'share_tt') {
                    $gia1 = 10;
                } elseif ($page == 'view_web') {
                    $gia1 = 20;
                } elseif ($page == 'sub_ytb') {
                    $gia1 = 700;
                    $gia2 = 800;
                } elseif ($page == 'view_ytb') {
                    $gia1 = 42;
                    $gia2 = 45;
                    $gia3 = 65;
                } elseif ($page == 'like_ytb') {
                    $gia1 = 70;
                }
                // kết thúc set giá thành viên    
            }
        }
    } else {
        $gia1 = '1000';
        $gia2 = '1000';
        $gia3 = '1000';
        $gia4 = '1000';
        $gia5 = '1000';
        $gia6 = '1000';
        $gia7 = '1000';
        $gia8 = '1000';
        $gia9 = '1000';
        $gia10 = '1000';
        $gia11 = '1000';
        $gia12 = '1000';
    }
}

if (isset($admin)) {
    if ($admin == 1) {
        if ($row['rule'] !== '99') {
            header('location: /index.php');
        }
    }
}

if (empty($hdq)) {
    if (!isset($_SESSION['u'])) {
        if (empty($u)) {
            header('location: /landing.php?redirect=' . $urll . '');
        }
    } elseif (isset($_SESSION['u'])) {
        if (isset($u)) {
            if ($u == 'login' || $u == 'reg') {
                header('location: /index.php');
            }
        }
    }
}

if (_PHPVERSION_ > _PHPRUN_ && $domain == _SITE_) {
    echo '{"status":"error","message":"Phiên bản PHP hiện tại không còn được hỗ trợ, vui lòng liên hệ Quản trị viên để nâng cấp lên phiên bản mới nhất, xin cảm ơn!","current_PHP_version":"' . _PHPRUN_ . '","latest_PHP_version":"' . _PHPVERSION_ . '"}';
    die();
}
