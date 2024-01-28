<?php
require_once('../_System/db.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed!']);
    exit();
}

$array = [];
if (isset($login)) {
    if ($_GET['act'] == 'check') {
        $time = time();
        $tcheck = $time - 900;
        $qcc = mysqli_query($db, "SELECT * FROM `momo` WHERE `user` = '$login' AND `time` > '$tcheck' AND `hien` = '0' ORDER BY id DESC LIMIT 1");
        $qc = mysqli_num_rows($qcc);
        if ($qc == 1) {
            $quan = mysqli_fetch_assoc($qcc);
            $vn = $quan['vnd'];
            $id = $quan['id'];
            $array['status'] = 'success';
            $array['username'] = $login;
            $array['message'] = 'Nạp thành công ' . number_format(floatval($vn)) . 'VNĐ từ ' . $quan['app'] . ' vào tài khoản!';
            $array['show'] = '1';
            $array['step'] = '1';
            mysqli_query($db, "UPDATE `momo` SET `hien`= '1' WHERE `id`='$id'");
            echo json_encode($array);
            exit();
        } else {
            $array['status'] = 'error';
            $array['username'] = $login;
            $array['message'] = 'Không có giao dịch nào mới!';
            $array['show'] = '0';
            $array['step'] = '2';
            echo json_encode($array);
            exit();
        }
    } else {
        $array['status'] = 'error';
        $array['username'] = $login;
        $array['message'] = 'Không có giao dịch nào mới!';
        $array['show'] = '0';
        $array['step'] = '3';
        echo json_encode($array);
        exit();
    }
} else {
    $array['status'] = 'error';
    $array['username'] = NULL;
    $array['message'] = 'Bạn chưa đăng nhập!';
    $array['show'] = '2';
    $array['step'] = '4';
    echo json_encode($array);
    exit();
}
