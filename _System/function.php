<?php
require_once('db.php');

function fb($dv, $time, $func, $type)
{
    global $db;
    $res = mysqli_query($db, "SELECT sum($func) FROM $type WHERE `dv` = '$dv' AND `time` > '$time'");
    $row = mysqli_fetch_row($res);
    $sum = $row[0];
    $result = number_format($sum);
    return $result;
}

function total($dv, $time, $type, $num = 0)
{
    global $db;
    //set time

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $tz = new DateTimeZone('Asia/Ho_Chi_Minh');
    $tomorrow = date("Y-m-d 00:00:00", strtotime("yesterday") + 86400);
    $tomorrow = strtotime($tomorrow);

    $yesterday = $tomorrow - 86400;

    $firstDay = new DateTime('first day of this month', $tz);
    $firstDay = $firstDay->format("Y-m-d");
    $firstDay = strtotime($firstDay);


    //set giá view fb
    $gview = 3.5;
    //set giá mắt fb
    $gmat1 = 4;
    $gmat2 = 1.5;


    if ($dv == 'Like') { //Like Facebook
        $gia1 = 4; //Server 1
        $gia2 = 10; // 2
        $gia3 = 15; // 3
        $gia4 = 0; // 4
        $gia5 = 4; // 5
    } elseif ($dv == 'Sub') {
        $gia1 = 24;
        $gia2 = 19;
        $gia3 = 7;
        $gia4 = 15;
        $gia5 = 6;
        $gia6 = 17;
        $gia7 = 21;
    } elseif ($dv == 'Cmt') {
        $gia1 = 40;
    } elseif ($dv == 'Share') {
        $gia1 = 10;
        $gia2 = 6;
        $gia3 = 0;
    } elseif ($dv == 'view') {
        $gia1 = 2.9;
        $gia2 = 5.8;
        $gia3 = 17;
    } elseif ($dv == 'mat') {
        $gia1 = 2.9;
        $gia2 = 1.3;
    } elseif ($dv == 'fb_group') {
        $gia1 = 47;
        $gia2 = 30;
        $gia3 = 23;
    } elseif ($dv == 'fb_page') {
        $gia1 = 25;
        $gia2 = 35;
        $gia3 = 8;
    } elseif ($dv == 'fb_feeling') {
        $gia1 = 10;
        $gia2 = 7;
    } elseif ($dv == 'fb_viewstory') {
        $gia1 = 4;
    } elseif ($dv == 'ins_follow') {
        $gia1 = 91;
        $gia2 = 13;
        $gia3 = 1;
    } elseif ($dv == 'ins_like') {
        $gia1 = 47;
        $gia2 = 35;
        $gia3 = 0.8;
    } elseif ($dv == 'ins_view') {
        $gia1 = 0.113;
    } elseif ($dv == 'tiktok_follow') {
        $gia1 = 47;
    } elseif ($dv == 'tiktok_like') {
        $gia1 = 19;
        $gia2 = 19;
        $gia3 = 19;
        $gia4 = 10;
    } elseif ($dv == 'tiktok_like_tay') {
        $gia1 = 0.5;
    } elseif ($dv == 'tiktok_view') {
        $gia1 = 0.001;
        $gia2 = 0.12;
        $gia3 = 0.001;
    } elseif ($dv == 'ws_view') {
        $gia1 = 10;
    } elseif ($dv == 'ytb_view') {
        $gia1 = 20;
        $gia2 = 44;
    } elseif ($dv == 'ytb_sub') {
        $gia1 = 622;
    }
    if ($time == $yesterday) {
        $result = mysqli_query($db, "SELECT * FROM `$type` WHERE `dv` = '$dv' AND `time` > '$time' AND `time` < '$tomorrow'");
    } else {
        $result = mysqli_query($db, "SELECT * FROM `$type` WHERE `dv` = '$dv' AND `time` > '$time'");
    }
    $total = 0;
    while ($ro = mysqli_fetch_assoc($result)) {
        $sv = $ro['nse']; //sv bình thường
        $fsv = $ro['bh']; //sv follow
        $sotien = $ro['sotien'];
        $sl = $ro['sl'];
        $dvv = $ro['dv'];
        $gsv = $ro['nse']; // sv group, share
        if ($dv == 'Like') {
            if ($sv == 1) {
                $so = $sotien - ($sl * $gia1);
            } elseif ($sv == 2) {
                $so = $sotien - ($sl * $gia2);
            } elseif ($sv == 3) {
                $so = $sotien - ($sl * $gia3);
            } elseif ($sv == 4) {
                $so = $sotien - ($sl * $gia4);
            } elseif ($sv == 10) {
                $so = $sotien - ($sl * $gia5);
            }
        } elseif ($dv == 'Sub') {
            if ($fsv == 1) {
                $so = $sotien - ($sl * $gia1);
            } elseif ($fsv == 2) {
                $so = $sotien - ($sl * $gia2);
            } elseif ($fsv == 3) {
                $so = $sotien - ($sl * $gia3);
            } elseif ($fsv == 4) {
                $so = $sotien - ($sl * $gia4);
            } elseif ($fsv == 5) {
                $so = $sotien - ($sl * $gia5);
            } elseif ($fsv == 6) {
                $so = $sotien - ($sl * $gia6);
            } elseif ($fsv == 7) {
                $so = $sotien - ($sl * $gia7);
            }
        } elseif ($dv == 'Cmt') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'Share') {
            if ($gsv == 'Server Share 1') {
                $so = $sotien - ($sl * $gia1);
            } elseif ($gsv == 'Server Share 2') {
                $so = $sotien - ($sl * $gia2);
            } elseif ($gsv == 'Server Share 3') {
                $so = $sotien - ($sl * $gia3);
            }
        } elseif ($dv == 'view') {
            if ($ro['phut'] == 0) {
                $so = ($sl * $gview) - ($sl * $gia1);
            } elseif ($ro['phut'] == 1) {
                $so = ($sl * $gview * 2) - ($sl * $gia2);
            }
        } elseif ($dv == 'mat') {
            $phut = $ro['phut'];
            if ($ro['sv'] == 'Server Live 1') {
                $so = ($sl * $gmat1 * $phut) - ($sl * $gia1 * $phut);
            } elseif ($ro['sv'] == 'Server Live 2') {
                $so = ($sl * $gmat2 * $phut) - ($sl * $gia2 * $phut);
            }
        } elseif ($dv == 'fb_group') {
            if ($gsv == 'Server Group 1') {
                $so = $sotien - ($sl * $gia1);
            } elseif ($gsv == 'Server Group 2') {
                $so = $sotien - ($sl * $gia2);
            } elseif ($gsv == 'Server Group 3') {
                $so = $sotien - ($sl * $gia3);
            }
        } elseif ($dv == 'fb_page') {
            if ($gsv == 'Server Fanpage 1') {
                $so = $sotien - ($sl * $gia1);
            } elseif ($gsv == 'Server Fanpage 2') {
                $so = $sotien - ($sl * $gia2);
            } elseif ($gsv == 'Server Fanpage 3') {
                $so = $sotien - ($sl * $gia3);
            }
        } elseif ($dv == 'fb_feeling') {
            if ($gsv == 'Server Cảm Xúc 1') {
                $so = $sotien - ($sl * $gia1);
            } elseif ($gsv == 'Server Cảm Xúc 2') {
                $so = $sotien - ($sl * $gia2);
            }
        } elseif ($dv == 'fb_viewstory') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'ins_follow') {
            if ($gsv == 'Server Follow 1') {
                $so = $sotien - ($sl * $gia1);
            } elseif ($gsv == 'Server Follow 2') {
                $so = $sotien - ($sl * $gia2);
            } elseif ($gsv == 'Server Follow 3') {
                $so = $sotien - ($sl * $gia3);
            }
        } elseif ($dv == 'ins_like') {
            if ($gsv == 'Server Like 1') {
                $so = $sotien - ($sl * $gia1);
            } elseif ($gsv == 'Server Like 2') {
                $so = $sotien - ($sl * $gia2);
            } elseif ($gsv == 'Server Like 3') {
                $so = $sotien - ($sl * $gia3);
            }
        } elseif ($dv == 'ins_view') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'tiktok_follow') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'tiktok_like') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'tiktok_like_tay') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'tiktok_view') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'ws_view') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'ytb_sub') {
            $so = $sotien - ($sl * $gia1);
        } elseif ($dv == 'ytb_view') {
            if ($gsv == 'Server View 1') {
                $so = $sotien - ($sl * $gia1);
            } elseif ($gsv == 'Server View 2') {
                $so = $sotien - ($sl * $gia2);
            }
        }

        $total = $total + $so;
    }
    if ($num == 1) {
        $result = $total;
    } else {
        $result = number_format($total);
    }
    return $result;
}

function totalall($time)
{
    // global total;
    $q1 = total("Like", $time, "dichvu", "1");
    $q2 = total("Sub", $time, "dichvu", "1");
    $q3 = total("Cmt", $time, "dichvu", "1");
    $q4 = total("view", $time, "video", "1");
    $q5 = total("mat", $time, "video", "1");
    $q6 = total("fb_group", $time, "dv_other", "1");
    $q7 = total("fb_page", $time, "dv_other", "1");
    $q8 = total("fb_feeling", $time, "dv_other", "1");
    $q9 = total("fb_viewstory", $time, "dv_other", "1");
    $q10 = total("ins_follow", $time, "dv_other", "1");
    $q11 = total("ins_like", $time, "dv_other", "1");
    $q12 = total("tiktok_follow", $time, "dv_other", "1");
    $q13 = total("tiktok_like", $time, "dv_other", "1");
    $q14 = total("tiktok_view", $time, "dv_other", "1");
    $q15 = total("ws_view", $time, "dv_other", "1");
    $q16 = total("Share", $time, "dichvu", "1");
    $total = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10 + $q11 + $q12 + $q13 + $q14 + $q15 + $q16;
    $result = number_format($total);
    return $result;
}

function check_isMobile()
{
    $is_mobile = '0';
    if (preg_match('/(android|iphone|ipad|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $is_mobile = 1;
    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']))))
        $is_mobile = 1;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array('w3c ', 'acs-', 'alav', 'alca', 'amoi', 'andr', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-');

    if (in_array($mobile_ua, $mobile_agents))
        $is_mobile = 1;

    if (isset($_SERVER['ALL_HTTP'])) {
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'OperaMini') > 0)
            $is_mobile = 1;
    }
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') > 0)
        $is_mobile = 0;
    return $is_mobile;
}

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

function trangthai($tt)
{
    if ($tt == 1) {
        echo '<span class="badge bg-primary">Đang Xử Lý</span>';
    } elseif ($tt == 2) {
        echo '<span class="badge bg-success">Hoàn Thành</span>';
    } elseif ($tt == 3) {
        echo '<span class="badge bg-warning">Đang Chạy</span>';
    } elseif ($tt == 4) {
        echo '<span class="badge bg-danger">Bị Hủy</span>';
    } elseif ($tt == 5) {
        echo '<span class="badge bg-danger">Hết Hạn</span>';
    } elseif ($tt == 6) {
        echo '<span class="badge bg-danger">Link Die</span>';
    } elseif ($tt == 7) {
        echo '<span class="badge bg-warning">Lỗi</span>';
    } elseif ($tt == 8) {
        echo '<span class="badge bg-danger">Đã Hủy & Hoàn Tiền</span>';
    }
}

function dichvut($dv)
{
    if ($dv == 'Like') {
        echo '<span class="badge bg-success">Mua Like</span>';
    } elseif ($dv == 'Cmt') {
        echo '<span class="badge bg-danger">Tăng Comment</span>';
    } elseif ($dv == 'Share') {
        echo '<span class="badge bg-warning">Mua Share</span>';
    } elseif ($dv == 'Sub') {
        echo '<span class="badge bg-primary">Mua Follow</span>';
    } elseif ($dv == 'view') {
        echo '<span class="badge bg-primary">Mua View</span>';
    } elseif ($dv == 'mat') {
        echo '<span class="badge bg-primary">Mua Mắt</span>';
    } elseif ($dv == 'fb_likecmt') {
        echo '<span class="badge bg-info">Like Cmt</span>';
    }
}

function limit_text($text, $limit)
{
    if (str_Word_count($text, 0) > $limit) {
        $words = str_Word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function time_func($time_ago)
{
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        echo "Cách đây $seconds giây";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            echo "Cách đây 1 phút";
        } else {
            echo "Cách đây $minutes phút";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            echo "Cách đây 1 tiếng";
        } else {
            echo "Cách đây $hours tiếng";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            echo "Ngày hôm qua";
        } else {
            echo "Cách đây $days ngày";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            echo "Cách đây 1 tuần";
        } else {
            echo "Cách đây $weeks tuần";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            echo "Cách đây 1 tháng";
        } else {
            echo "Cách đây $months tháng";
        }
    } else {
        if ($years == 1) {
            echo "Cách đây 1 năm";
        } else {
            echo "Cách đây $years năm";
        }
    }
}
function incrementalHash($len = 5)
{
    $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $base = strlen($charset);
    $result = '';

    $now = explode(' ', microtime())[1];
    while ($now >= $base) {
        $i = $now % $base;
        $result = $charset[$i] . $result;
        $now /= $base;
    }
    return substr($result, -5);
}
