<?php

$hdq = 'ok';
$page = "like_fb_v2";
require_once('../../../_System/db.php');
include('../../../module/autoccv2.php');
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo ''.$_SERVER['REQUEST_METHOD'].' method requests are not accepted for this resource';
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
        if ($cd) {
            $gt = time();
            $tko = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code` = '$cd' AND `ex` > '$gt' AND `site` = '$site'");
            $tko = mysqli_num_rows($tko);
            if ($tko == 1) {
                $u = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code`='$cd' AND `site` = '$site'");
                $u = mysqli_fetch_assoc($u);
                $dis = $u['dis'];
                if ($sv == 1) {
                    $tongtien = ($sl * $gia1) - (($sl * $gia1) / 100 * $dis);
                    $nse = 'Chậm';
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                    $nse = 'Trung Bình';
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3) - (($sl * $gia3) / 100 * $dis);
                    $nse = 'Thông Thường';
                } elseif ($sv == 4) {
                    $tongtien = ($sl * $gia4) - (($sl * $gia4) / 100 * $dis);
                    $nse = 'Nhanh';
                }
            } else {

                if ($sv == 1) {
                    $tongtien = ($sl * $gia1);
                    $nse = 'Chậm';
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2);
                    $nse = 'Trung Bình';
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3);
                    $nse = 'Thông Thường';
                } elseif ($sv == 4) {
                    $tongtien = ($sl * $gia4);
                    $nse = 'Nhanh';
                }
            }
        }

        if ($sv == 1 || $SV == 2 || $sv == 3 || $sv == 4) {
            if (empty($id)) {
                $array["status"] = 'error';
                $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
            } elseif (empty($sl)) {
                $array["status"] = 'error';
                $array["msg"] = 'Vui lòng nhập số lượng Like!';
            } elseif ($sl < $s['min5']) {
                $array["status"] = 'error';
                $array["msg"] = 'Số lượng phải lớn hơn ' . $s['min5'] . ' Like';
            } elseif ($sl > $s['max5']) {
                $array["status"] = 'error';
                $array["msg"] = 'Số lượng tối đa ' . $s['max5'] . ' Like 1 lần ( Đợi lên xong hãy cài tiếp ( xem thực tế ở ngoài ) )!';
            } elseif ($row['vnd'] < $tongtien) {
                $array["status"] = 'error';
                $array["msg"] = 'Bạn không đủ tiền!';
            } else {
                $nd1 = 'Mua Like Bài Viết V2 ID:';
                $bd = $tongtien;
                $gt = '-';
                $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                $goc = $row['vnd'];
                $time = time();
                $send = autocc('' . $id . '', '' . $sl . '', '' . $sv . '');
                if ($send !== 'false') {
                    $check = json_decode($send);
                    $idgd2 = $check->idgd;
                    $iddon = $check->iddon;
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fblike_v2',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `sttdone` = '0',`idgd`='$idgd2',`iddon`='$iddon'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");

                    $array["status"] = 'success';
                    $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'Lỗi ID tăng like vui lòng kiểu tra lại!!';
                }
            }
        } else {
            $array["status"] = 'error';
            $array["msg"] = 'Lỗi Server Tăng Like Không Đúng!';
        }
    } else {
        $array["status"] = 'error';
        $array["msg"] = 'Token không tồn tại!';
    }
    echo json_encode($array);
} else {
    echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
}
