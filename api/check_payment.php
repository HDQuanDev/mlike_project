<?php
require_once('../_System/db.php');
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
                echo "<script>swal('Hệ Thống!','Nạp thành công " . number_format(floatval($vn)) . "VNĐ từ " . $quan['app'] . " vào tài khoản!','success');</script>";
                $id = $quan['id'];
                mysqli_query($db, "UPDATE `momo` SET `hien`= '1' WHERE `id`='$id'");
            }
        }
    } else {
        echo "<script>window.location.href='/index.php';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href='/index.php';</script>";
    exit;
}
