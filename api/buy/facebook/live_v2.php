<?php

$hdq = "ok";
$page = 'live_fb_v2';
require_once('../../../_System/db.php');
require_once('../../../module/autofbpro.php');
$min = '50';
$max = '3000';
$gia = $gia1;
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['sv']) && isset($_POST['phut'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sl = mysqli_real_escape_string($db, $_POST['sl']);
    $phut = mysqli_real_escape_string($db, $_POST['phut']);
    $sv = mysqli_real_escape_string($db, $_POST['sv']);
    $cd = mysqli_real_escape_string($db, $_POST['gift']);
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
    $tko = mysqli_num_rows($uu);
    if ($tko == '1') {
        $row = mysqli_fetch_assoc($uu);
        $login = $row['username'];
        if (isset($cd)) {
            $gt = time();
            $tko = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code` = '$cd' AND `ex` > '$gt' AND `site` = '$site'");
            $tko = mysqli_num_rows($tko);
            if ($tko == 1) {
                $u = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code`='$cd' AND `site` = '$site'");
                $u = mysqli_fetch_assoc($u);
                $dis = $u['dis'];
                if ($sv == 1) {
                    $tongtien = ($sl * $gia * $phut) - (($sl * $gia * $phut) / 100 * $dis);
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2 * $phut) - (($sl * $gia2 * $phut) / 100 * $dis);
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3 * $phut) - (($sl * $gia3 * $phut) / 100 * $dis);
                }
            } else {
                if ($sv == 1) {
                    $tongtien = ($sl * $gia * $phut);
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2 * $phut);
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3 * $phut);
                }
            }
        }
        if (empty($id)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số ID Livestream Facebook!';
        } elseif (empty($sl)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số lượng Mắt!';
        } elseif (empty($phut)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số phút muốn xem!';
        } elseif ($sl < $min) {
            $array["status"] = 'error';
            $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
        } elseif ($sl > $max) {
            $array["status"] = 'error';
            $array["msg"] = 'Số lượng tối đa ' . $max . '!';
        } elseif ($phut < '30' || $phut > '300') {
            $array["status"] = 'error';
            $array["msg"] = 'Số phút bạn muốn xem phải trong khoảng 30 phút đến 300 phút!';
        } elseif ($row['vnd'] < $tongtien) {
            $array["status"] = 'error';
            $array["msg"] = 'Bạn không đủ tiền!';
        } else {
            if ($sv == 1) {
                $buff = autofb_live($id, $phut, $sl, "1", "1.9");
                $buff = json_decode($buff);
                if ($buff->status == '200') {
                    $nd1 = 'Tăng Mắt Livestream V2 ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(1) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'matv2',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '0', `sttdone` = '0', `sv` = 'Server Live V2 1'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 2) {
                $buff = autofb_live($id, $phut, $sl, "2", "4");
                $buff = json_decode($buff);
                if ($buff->status == '200') {
                    $nd1 = 'Tăng Mắt Livestream V2 ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(2) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'matv2',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '0', `sttdone` = '0', `sv` = 'Server Live V2 2'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 3) {
                $buff = autofb_live($id, $phut, $sl, "3", "3");
                $buff = json_decode($buff);
                if ($buff->status == '200') {
                    $nd1 = 'Tăng Mắt Livestream V2 ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(3) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'matv2',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '0', `sttdone` = '0', `sv` = 'Server Live V2 3'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Lỗi Server Tăng Mắt Không Đúng!';
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
