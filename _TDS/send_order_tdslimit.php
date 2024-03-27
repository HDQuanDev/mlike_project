<?php
$hdq = 'ok';
require_once('../_System/db.php');
require_once('../module/tdslimit.php');

$result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '1' AND `sttdone` = '0' AND `iddon` = '2005' AND `bh` = '19' AND `code` > '100' ORDER BY RAND() LIMIT 2");
while ($ro = mysqli_fetch_assoc($result1)) {
    $idbuff = $ro['profile'];
    $sl = $ro['sl'];
    $done = $ro['done'];
    $limit = ($sl - $done);
    $code = $ro['code'];
    if ($ro['sttdone'] == '0') {
        if ($limit > '19') {
            //echo '3';
            $send = send_limit_tds("$idbuff", "$limit");
            $quan = json_decode($send);
            var_dump($quan);
            if ($quan->code == '100') {
                echo '4';
                $acc = $quan->acc;
                $damua = $quan->damua;
                $don = $done + $damua;
                if ($don >= 1 && $don < $sl) {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3', `done` = '$don' WHERE `code` = '$code' AND `nse` = '1' AND `sttdone` = '0' AND `iddon` = '2005'");
                } elseif ($don >= ($sl - 50)) {
                    mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1', `done` = '$don' WHERE `code` = '$code' AND `nse` = '1' AND `sttdone` = '0' AND `iddon` = '2005'");
                }
                echo 'id: ' . $idbuff . ' -> ' . $damua . ' (' . $acc . ')<br>';
                $fp = @fopen('list.txt', "a");
                $data = 'id: ' . $idbuff . ' -> ' . $damua . ' (' . $acc . ') [server like 1]
            ';
                fwrite($fp, $data);
               
            }elseif($quan->code == '222'){
                mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '4', `sttdone` = '1' WHERE `code` = '$code' AND `nse` = '1' AND `iddon` = '2005'");
                ECHO 'DEL '.$idbuff;
            } elseif ($quan->code == '200') {
                echo $quan->msg;
            } elseif ($quan->code == '300') {
                echo $quan->msg;
            }
            $fp = @fopen('log.txt', "a+");
            $data = 'id: '.$idbuff.' -> '.$quan->msg.' ['.$$date = date('d/m/Y h:i:s a', time()).'] -> server like 1
        ';
            fwrite($fp, $data);
        } else {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `code` = '$code' AND `nse` = '1' AND `sttdone` = '0' AND  `iddon` = '2005' ");
        }
      //  echo '2';
    }
   // sleep(3);
    //echo 'a';
}

