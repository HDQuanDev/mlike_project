<?php

$hdq = 'login';
require_once('../../_System/db.php');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://tanglikecheo.com/api/history?litmit=10&provider=instagram&type=comment',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2MDQ5NTQzODU5YmU2NjUzODg4NmRmNDYiLCJwYXNzd29yZCI6ImIyZjc3OTk1YTBjODFkODcxZDViNWFiMDE5NzAwM2UxIiwic3RhdHVzIjowLCJpYXQiOjE2MzM5NjE2NzEsImV4cCI6NTIzMzk1ODA3MX0.reG80i5JeLPQbzRRuFwGjYIELNsjuqMwflGJWh-_GCyS-mrMDcZsijZPsfGVfd9215I0__rYH4ZIg4vFfef-Qw'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$quan = json_decode($response, true);

foreach($quan['data'] as $result) {
    $did = $result['object_id'];
    $check = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'cmt_ig' AND `sttdone` = '0' AND `profile` LIKE '%$did%'");
    $check = mysqli_num_rows($check);
    if ($check != 0) {
        $datang = $result['count_is_run'];
        $u = mysqli_query($db, "SELECT * FROM `dv_other` WHERE `dv` = 'cmt_ig' AND `sttdone` = '0' AND `profile` LIKE '%$did%'");
        $u = mysqli_fetch_assoc($u);
        $goc = $u['sl'];
        mysqli_query($db, "UPDATE `dv_other` SET `done` = '$datang' WHERE `dv` = 'cmt_ig' AND `sttdone` = '0' AND `profile` LIKE '%$did%'");
        echo 'ID: ' . $did . '-> DONE: ' . $datang . ' / ' . $goc . '<br>';
        if ($datang >= '1' && $datang < $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '3' WHERE `dv` = 'cmt_ig' AND `sttdone` = '0' AND `profile` LIKE '%$did%'");
        } elseif ($datang >= $goc) {
            mysqli_query($db, "UPDATE `dv_other` SET `trangthai` = '2', `sttdone` = '1' WHERE `dv` = 'cmt_ig' AND `sttdone` = '0' AND `profile` LIKE '%$did%'");
        }
    }
}
//echo count(json_decode($quan->data));
