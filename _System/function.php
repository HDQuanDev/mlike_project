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
