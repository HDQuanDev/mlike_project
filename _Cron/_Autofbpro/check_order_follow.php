<?php

$hdq = 'login';
require_once('../../_System/db.php');
include('../../module/autofbpro.php');
include('../../module/vnfb.php');
// sv 1

$result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Sub' AND `nse` = 'Server Follow 1' AND `sttdone` = '0' AND `time` > '1634283675' ORDER BY id DESC LIMIT 15");
while($ro = mysqli_fetch_assoc($result1)) {
    $id = $ro['profile']; //id bai viet
    $ids = $ro['iddon'];
    $result = check_follow_vnfb("$ids");
    $quan = json_decode($result);
    if($quan->success = 0) {
        echo 'lỗi rồi';
    } else {
        $done = $quan->data[0]->run_count;
        $sgoc = $quan->data[0]->first_count;
        mysqli_query($db, "UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `nse` = 'Server Follow 1'");
        echo 'id: '.$id.' -> '.$done.'<br>';
        $goc = $ro['sl'];
        if($done >= 1 && $done < $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `nse` = 'Server Follow 1'");
        } elseif($done >= $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `nse` = 'Server Follow 1'");
        }
    }

}
//echo $quan;

// sv 2
$quan = follow_check("2");
$giai = json_decode($quan, true);
$info = $giai["data"];
for($i = 0;$i < count($info[$i]);$i++) {
    if($info[$i]['price_per'] == 19) {
        $id = $info[$i]['object_id'];
        $tko = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 2'");
        $tko = mysqli_num_rows($tko);
        if($tko != 0) {
            $done = $info[$i]['count_success'];
            $sgoc = $info[$i]['subscribers'];
            $u = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 2'");
            $u = mysqli_fetch_assoc($u);
            $goc = $u['sl'];
            mysqli_query($db, "UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'Sub' AND `nse` = 'Server Follow 2'");
            echo 'id: '.$id.' -> '.$done.'<br>';
            if($done >= 1 && $done < $goc) {
                mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 2'");
            } elseif($done >= $goc) {
                mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'Sub' AND `nse` = 'Server Follow 2'");
            }
        }
    }
}

// sv 1

$result1 = mysqli_query($db, "SELECT * FROM `dichvu` WHERE `dv` = 'Sub' AND `nse` = 'Server Follow 9' AND `sttdone` = '0' AND `time` > '1634283675' ORDER BY id DESC LIMIT 15");
while($ro = mysqli_fetch_assoc($result1)) {
    $id = $ro['profile']; //id bai viet
    $ids = $ro['iddon'];
    $result = check_follow_vnfb("$ids");
    $quan = json_decode($result);
    if($quan->success = 0) {
        echo 'lỗi rồi';
    } else {
        $done = $quan->data[0]->run_count;
        $sgoc = $quan->data[0]->first_count;
        mysqli_query($db, "UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `nse` = 'Server Follow 9'");
        echo 'id: '.$id.' -> '.$done.'<br>';
        $goc = $ro['sl'];
        if($done >= 1 && $done < $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `nse` = 'Server Follow 9'");
        } elseif($done >= $goc) {
            mysqli_query($db, "UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `nse` = 'Server Follow 9'");
        }
    }

}
/*
// sv 3
$quan = follow_check("3");
$giai = json_decode($quan, true);
$info = $giai["data"];
//echo $quan;
for($i=0;$i<count($info);$i++){
  if($info[$i]['price_per'] == 8){
  $id = $info[$i]['object_id'];
 // echo $id;
  $tko = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 3'");
                $tko = mysqli_num_rows($tko);
if($tko != 0){
  $done = $info[$i]['count_success'];
  $sgoc = $info[$i]['subscribers'];
$u = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 3'");
$u = mysqli_fetch_assoc($u);
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'Sub' AND `nse` = 'Server Follow 3'");
    echo 'id: '.$id.' -> '.$done.'<br>';
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 3'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'Sub' AND `nse` = 'Server Follow 3'");
    }
}
}
}


// sv 4

    $token = $s['tlc'];
    $time = time();
$result1 = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `dv` = 'Sub' AND `nse` = 'Server Follow 4' AND `sttdone` = '0' ORDER BY id DESC LIMIT 15");
while($ro = mysqli_fetch_assoc($result1))
            {
              $id = $ro['profile']; //id bai viet
$url = 'https://tanglikecheo.com/api/history?litmit=100&provider=facebook&type=follow&object_id='.$id.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_GET, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token;
    $headers[] = 't:' . $time;
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 $server_output = curl_exec ($ch);
 curl_close ($ch);
$result = $server_output;
$quan = json_decode($result);
if($quan->success = false){
    echo 'lỗi rồi';
}else{
    $done = $quan->data[0]->worker;
    $sgoc = $quan->data[0]->start;
mysqli_query($db,"UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `nse` = 'Server Follow 4'");
    echo 'id: '.$id.' -> '.$done.'<br>';
    $goc = $ro['sl'];
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `nse` = 'Server Follow 4'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `nse` = 'Server Follow 4'");
    }
}

            }

// sv 5
$quan = follow_check("4");
$giai = json_decode($quan, true);
$info = $giai["data"];
//echo $quan;
for($i=0;$i<count($info);$i++){
  if($info[$i]['price_per'] == 6){
  $id = $info[$i]['object_id'];
 // echo $id;
  $tko = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 5'");
                $tko = mysqli_num_rows($tko);
if($tko != 0){
  $done = $info[$i]['count_success'];
  $sgoc = $info[$i]['subscribers'];
$u = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 5'");
$u = mysqli_fetch_assoc($u);
$goc = $u['sl'];
mysqli_query($db,"UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `sttdone` = '0' AND `dv` = 'Sub' AND `nse` = 'Server Follow 5'");
    echo 'id: '.$id.' -> '.$done.'<br>';
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `dv` = 'Sub' AND `sttdone` = '0' AND `nse` = 'Server Follow 5'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `dv` = 'Sub' AND `nse` = 'Server Follow 5'");
    }
}
}
}

// sv 6

    $time = time();
$result1 = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `dv` = 'Sub' AND `nse` = 'Server Follow 6' AND `sttdone` = '0' ORDER BY id DESC LIMIT 15");
while($ro = mysqli_fetch_assoc($result1))
            {
              $id = $ro['profile']; //id bai viet
$idgd = $ro['iddon'];
$data = '{
    "service_codes": ["'.$idgd.'"]
}
';
$raw = 'https://api.autolike.cc/public-api/v1/agency/services/all-by-codes';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $raw);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$headers = array();
    $headers[] = 'token: S4X92NRH9PVD2WAMRH45LR6AQBJAPVRA';
    $headers[] = 'agency-secret-key: 279890eb-9833-11eb-a453-d09466848fec';
    $headers[] = 'Cookie: __cfduid=dbd2a4e5f2811b711018f1a21fa871d9c1619179213';
    $headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 $response = curl_exec($ch);

$result = $response;
$quan = json_decode($result);
if($quan->code !== 200){
var_dump($quan);
}else{
    $done = $quan->data[0]->number_success;
    $sgoc = $quan->data[0]->follows_start;
mysqli_query($db,"UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `nse` = 'Server Follow 6'");
    echo 'id: '.$id.' -> '.$done.'<br>';
    $goc = $ro['sl'];
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `nse` = 'Server Follow 6'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `nse` = 'Server Follow 6'");
    }
}

            }

// sv 4

    $token = $s['tlc'];
    $time = time();
$result1 = mysqli_query($db,"SELECT * FROM `dichvu` WHERE `dv` = 'Sub' AND `nse` = 'Server Follow 8' AND `sttdone` = '0' ORDER BY id DESC LIMIT 15");
while($ro = mysqli_fetch_assoc($result1))
            {
              $id = $ro['profile']; //id bai viet
$url = 'https://tanglikecheo.com/api/history?litmit=100&provider=facebook&type=follow&object_id='.$id.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_GET, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: ' . $token;
    $headers[] = 't:' . $time;
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 $server_output = curl_exec ($ch);
 curl_close ($ch);
$result = $server_output;
$quan = json_decode($result);
if($quan->success = false){
    echo 'lỗi rồi';
}else{
    $done = $quan->data[0]->worker;
    $sgoc = $quan->data[0]->start;
mysqli_query($db,"UPDATE `dichvu` SET `done` = '$done', `sve` = '$sgoc' WHERE `profile` = '$id' AND `nse` = 'Server Follow 8'");
    echo 'id: '.$id.' -> '.$done.'<br>';
    $goc = $ro['sl'];
    if($done >= 1 && $done < $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '3' WHERE `profile` = '$id' AND `nse` = 'Server Follow 8'");
    }elseif($done >= $goc){
        mysqli_query($db,"UPDATE `dichvu` SET `trangthai` = '2', `sttdone` = '1' WHERE `profile` = '$id' AND `nse` = 'Server Follow 8'");
    }
}

            }
            */
