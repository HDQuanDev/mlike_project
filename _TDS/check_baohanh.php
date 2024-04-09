<?php

$hdq = 'ok';
require_once('../_System/db.php');
require_once('../module/tds.php');
$time = time();
$timeex = $time + 2592000;
$result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Like' AND `nse` = '3' AND `bh` = '2' ORDER BY RAND() LIMIT 20");
while($ro = mysqli_fetch_assoc($result1)) {
    $t = $ro['time'];
    $ex = $t + 2592000;
    if($ex < $time) {
        $id = $ro['profile'];
        $sl = $ro['sl'];
        $url = 'https://graph.facebook.com/'.$id.'/likes?summary=true&access_token='.$s['token'].'';
        $check = json_decode(file_get_contents($url));
        $total_like = $check->data[0]->summary->total_count;
        if($total_like < $sl) {
            $like_bu = $sl - $total_like;
            if($like_bu > 50) {
                $date_create =  date("Y-m-d H:i:s");
                $send_api = send_tds(trim($id), trim($like_bu), '', $date_create);
            }
        }
    }
}
