<?php
$hdq = 'ok';
require_once('../_System/db.php');
require_once('../module/tdslimit.php');
switch ($_GET['act']) {
    case '1':
        $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '7' AND `sttdone` = '0' AND `time` > '1637059909' AND `code` > '100' LIMIT 1");
        $ro = mysqli_fetch_assoc($result1);
        $idbuff = $ro['profile'];
        $sl = $ro['sl'];
        $done = $ro['done'];
        $limit = ($sl - $done);
        $code = $ro['code'];
        if ($ro['sttdone'] == '0') {
            if ($limit >= '20') {
                $acc = get_limit('user');
                $pass = get_limit('pass');
                $proxy = get_limit('proxy');
                $proxypass = get_limit('proxypass');
                echo '{"id":"' . $ro['profile'] . '","sl":"' . $limit . '","code":"' . $code . '","acc":"' . $acc . '","pass":"' . $pass . '","proxy":"' . $proxy . '","proxypass":"' . $proxypass . '","datang":"' . $ro['done'] . '","goc":"' . $ro['sl'] . '"}';
            } else {
                mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `code` = '$code'");
            }
        }
        break;
    case '2':
        $result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '1' AND `sttdone` = '0' AND `iddon` = '2005' AND `bh` = '19' ORDER BY `id` DESC");
        $ro = mysqli_fetch_assoc($result1);
        $idbuff = $ro['profile'];
        $sl = $ro['sl'];
        $done = $ro['done'];
        $limit = ($sl - $done);
        $code = $ro['code'];
        if ($ro['sttdone'] == '0') {
            if ($limit > '19') {
                if ($limit >= '20') {
                    $acc = get_limit('user');
                    $pass = get_limit('pass');
                    $proxy = get_limit('proxy');
                    $proxypass = get_limit('proxypass');
                    echo '{"id":"' . $ro['profile'] . '","sl":"' . $limit . '","code":"' . $code . '","acc":"' . $acc . '","pass":"' . $pass . '","proxy":"' . $proxy . '","proxypass":"' . $proxypass . '","datang":"' . $ro['done'] . '","goc":"' . $ro['sl'] . '"}';
                } else {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `code` = '$code'");
                }
            }
        }
        break;
    default:
        if ($_GET['done'] == '0') {
            $trangthai = $_GET['trangthai'];
            $code = $_GET['code'];
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '$trangthai', `done` = '0', `sttdone` = '1' WHERE `code` = '$code'");
        } else {
            $done = $_GET['done'];
            $trangthai = $_GET['trangthai'];
            $code = $_GET['code'];
            $tongxu = $_GET['tongxu'];
            $acc = $_GET['acc'];
            if ($trangthai == '2') {
                $stt = '1';
            } else {
                $stt = '0';
            }
            mysqli_query($db, "UPDATE `dichvu` SET `done` = `done` + '$done',`trangthai` = '$trangthai', `sttdone` = '$stt' WHERE `code` = '$code'");
            echo get_limit('updatexu', '' . $tongxu . '', '' . $acc . '');
        }
        break;
}
