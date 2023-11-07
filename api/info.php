<?php
header('Content-Type: text/html; charset=UTF-8');
set_time_limit(0);
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/ Ho_Chi_Minh');
$hdq = 'ok';
require_once('../_System/db.php');
switch ($_GET["act"]) {
    case 'get_money':
        $data = json_decode(file_get_contents("php://input"));
        $api = $data->api;
        $quan = array();
        if (isset($api)) {
            $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `api`='$api' AND `site` = '$site'");
            $tko = mysqli_num_rows($uu);
            if ($tko == '1') {
                $u = mysqli_fetch_assoc($uu);
                $quan["status"] = 'success';
                $quan["msg"] = 'Lấy Dữ Liệu Thành Công!';
                $quan["username"] = '' . $u['username'] . '';
                $quan["vnd"] = '' . $u['vnd'] . '';
                $quan["use"] = '' . $u['sd'] . '';
            } else {
                $quan["status"] = 'error';
                $quan["msg"] = 'API không tồn tại!';
            }
        } else {
            $quan["status"] = 'error';
            $quan["msg"] = 'Không đủ phần tử gọi đến!';
        }
        echo json_encode($quan);
        break;
}
