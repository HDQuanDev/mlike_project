<?php

$hdq = "ok";
$page = 'like_ig';
require_once('../../../_System/db.php');
require_once('../../../module/autofbpro.php');
require_once('../../../module/tlc.php');
require_once('../../../module/viewyt.php');
// Điều Chỉnh Giá
$gia = $gia1; // Sv1 Autofbpro
//Sv2 TLC
$min = '50';
$max = '2000';
$api = new Api();
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['sv'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sl = mysqli_real_escape_string($db, $_POST['sl']);
    $sv = mysqli_real_escape_string($db, $_POST['sv']);
    $cd = mysqli_real_escape_string($db, $_POST['gift']);
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
    $tko = mysqli_num_rows($uu);
    if ($tko == '1') {
        $row = mysqli_fetch_assoc($uu);
        $login = $row['username'];
        if ($sv == 1) {
            $tongtien = $sl * $gia;
            $nse = 'Server Like 1';
        } elseif ($sv == 2) {
            $tongtien = $sl * $gia2;
            $nse = 'Server Like 2';
        } elseif ($sv == 3) {
            $tongtien = $sl * $gia3;
            $nse = 'Server Like 3';
        }
        if (empty($id)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số ID!';
        } elseif (empty($sl)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số lượng!';
        } elseif ($sl < $min) {
            $array["status"] = 'error';
            $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
        } elseif ($sl > $max) {
            $array["status"] = 'error';
            $array["msg"] = 'Số lượng tối đa ' . $max . '!';
        } elseif ($row['vnd'] < $tongtien) {
            $array["status"] = 'error';
            $array["msg"] = 'Bạn không đủ tiền!';
        } else {
            if ($sv == 1) {
                $buff = ins("$id", "$sl", "like");
                $buff = json_decode($buff);
                if ($buff->status == 200) {
                    $nd1 = 'Tăng Like Instagram ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(1) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ins_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Like Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 2) {
                $buff = like_ins_tlc("$id", "$sl");
                $buff = json_decode($buff);
                if ($buff->success == true) {
                    $nd1 = 'Tăng Like Instagram ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(2) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ins_like',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '1', `sotien` = '$tongtien', `done` = '0', `idgd` = '5', `nse` = '$nse'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Like Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 3) {
                $order = $api->order(array('service' => 1470, 'link' => '' . $id . '', 'quantity' => $sl));
                if (isset($order)) {
                    $nd1 = 'Tăng Like Instagram ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(3) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'ins_like',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '1', `sotien` = '$tongtien', `done` = '$sl', `idgd` = '5', `nse` = '$nse'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Like Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Lỗi Server Tăng Like Không Đúng!';
            }
        }
    } else {
        $array["status"] = 'error';
        $array["msg"] = 'Token không tồn tại!';
    }
    echo json_encode($array);
} else {
    echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
}
