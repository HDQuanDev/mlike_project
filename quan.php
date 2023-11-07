<?php
require_once('_System/db.php');
require_once('module/tds.php');
$user = $s['user'];
$pass = $s['pass'];
$login_tds = json_decode(login($user, urlencode($pass)));
if ($login_tds->success == 'true') {
    $check = check_ls_like("65605018540794s01");
    $quan = json_decode($check, true);
    $info = $quan["data"][0];
    if (isset($info)) {
        echo json_encode($info);
    } else {
        echo 'a';
    }
}
