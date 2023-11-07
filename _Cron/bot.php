<?php
$hdq = 'login';
require_once('../_System/db.php');
require_once('../module/tiktok.php');
$time = time();
$result1 = mysqli_query($db, "SELECT * FROM `dv_other` WHERE (`dv` = 'tiktok_follow' OR `dv` = 'tiktok_like') AND `sttdone` = '10' ORDER BY RAND() LIMIT 10");
while ($ro = mysqli_fetch_assoc($result1)) {
    $sl = $ro["sl"];
    $goc = $ro["iddon"];
    $t = $sl + $goc;
    $dv = $ro["dv"];
    $id = $ro["cmt"];
    /*if ($dv == 'tiktok_view') {
        $tt = $t - 150;
        $url = "https://www.tiktok.com/@mlikevn/video/$id";
        $quan = json_decode(check_tt($url, "view"));
        $done = $quan->view;
        mysqli_query($db, "UPDATE `dv_other` SET `done` = '$done' WHERE `cmt` = '$id' AND `dv` = 'tiktok_view'");
        echo '(view) id: ' . $id . ' -> ' . $done . '<br>';
        $goc = $ro['sl'];
        if ($done >= 1 && $done < $t) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3' WHERE `cmt` = '$id' AND `dv` = 'tiktok_view'");
        } elseif ($done >= $tt) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '11' WHERE `cmt` = '$id' AND `dv` = 'tiktok_view'");
        }
    }else
    */
    if($dv == 'tiktok_follow'){
        $tt = $t - 10;
        $sl = $ro["sl"];
        $goc = $ro["iddon"];
        $t = $sl + $goc;
        $tt = $sl - 150;
        $dv = $ro["dv"];
        $id = $ro["cmt"];
            $url = $ro["idgd"];
            $quan = json_decode(check_tt($url, "follow"));
            $done = $quan->follow;
            mysqli_query($db, "UPDATE `dv_other` SET `done` = '$done' WHERE `cmt` = '$id' AND `dv` = 'tiktok_follow'");
            echo ''.$ro['id'].' (follow) id: ' . $id . ' -> ' . $done . '<br>';
            $goc = $ro['sl'];
            if ($done >= 1 && $done < $t) {
                mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3' WHERE `cmt` = '$id' AND `dv` = 'tiktok_follow'");
            } elseif ($done >= $tt) {
                mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '11' WHERE `cmt` = '$id' AND `dv` = 'tiktok_follow'");
            }
    }elseif ($dv == 'tiktok_like') {
        $tt = $t - 10;
        $url = "https://www.tiktok.com/@mlikevn/video/$id";
        $quan = json_decode(check_tt($url, "view"));
        $done = $quan->tim;
        mysqli_query($db, "UPDATE `dv_other` SET `done` = '$done' WHERE `cmt` = '$id' AND `dv` = 'tiktok_like'");
        echo ''.$ro['id'].' (like) id: ' . $id . ' -> ' . $done . '<br>';
        $goc = $ro['sl'];
        if ($done >= 1 && $done < $t) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3' WHERE `cmt` = '$id' AND `dv` = 'tiktok_like'");
        } elseif ($done >= $tt) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '11' WHERE `cmt` = '$id' AND `dv` = 'tiktok_like'");
        }
    }
}
