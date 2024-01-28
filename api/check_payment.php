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
        $tcheck = $time - 300;
        $qc = mysqli_query($db, "SELECT * FROM `momo` WHERE `user` = '$login' AND `time` > '$tcheck' AND `hien` = '0' ORDER BY id DESC LIMIT 1");
        $qc = mysqli_num_rows($qc);
        if ($qc == 1) {
            $result = mysqli_query($db, "SELECT * FROM `momo` WHERE `user` = '$login' AND `time` > '$tcheck' AND `hien` = '0' ORDER BY id DESC LIMIT 1");
            $quan = mysqli_fetch_assoc($result);
            if ($quan) {
                $vn = $quan['vnd'];
                $array['status'] = 'success';
                $array['message'] = 'Nạp thành công ' . number_format(floatval($vn)) . 'VNĐ từ ' . $quan['app'] . ' vào tài khoản!';
                $array['show'] = '1';
                mysqli_query($db, "UPDATE `momo` SET `hien`= '1' WHERE `id`='$id'");
            }
        } else {
            $array['status'] = 'error';
            $array['message'] = 'Không có giao dịch nào mới!';
            $array['show'] = '0';
        }
    } else {
        $array['status'] = 'error';
        $array['message'] = 'Không có giao dịch nào mới!';
        $array['show'] = '0';
    }
} else {
    $array['status'] = 'error';
    $array['message'] = 'Bạn chưa đăng nhập!';
    $array['show'] = '2';
}
echo json_encode($array);
