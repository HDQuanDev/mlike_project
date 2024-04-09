<?php

$hdq = "ok";
$page = 'follow_fb';
require_once('../../../_System/db.php');
include('../../../module/tlc.php');
require_once('../../../module/tds.php');
$min = '30';
$max = '100000';
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
            if (isset($cd)) {
                $gt = time();
                $tko = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code` = '$cd' AND `ex` > '$gt' AND `site` = '$site'");
                $tko = mysqli_num_rows($tko);
                if ($tko == 1) {
                    $u = mysqli_query($db, "SELECT * FROM `giftcode` WHERE `code`='$cd' AND `site` = '$site'");
                    $u = mysqli_fetch_assoc($u);
                    $dis = $u['dis'];
                    if ($sv == 1) {
                        $tongtien = ($sl * $gia1) - (($sl * $gia1) / 100 * $dis);
                        $nse = 'Server Follow 1';
                    }
                } else {
                    if ($sv == 1) {
                        $tongtien = ($sl * $gia1);
                        $nse = 'Server Follow 1';
                    }
                }
            }

            if (empty($id)) {
                $array["status"] = 'error';
                $array["msg"] = 'Vui lòng nhập số ID Profile Facebook!';
            } elseif (empty($sl)) {
                $array["status"] = 'error';
                $array["msg"] = 'Vui lòng nhập số lượng Follow!';
            } elseif ($sl < $s['submin']) {
                $array["status"] = 'error';
                $array["msg"] = 'Số lượng phải lớn hơn ' . $s['submin'] . '';
            } elseif ($sl > $s['submax']) {
                $array["status"] = 'error';
                $array["msg"] = 'Số lượng tối đa ' . $s['submax'] . '!';
            } elseif ($row['vnd'] < $tongtien) {
                $array["status"] = 'error';
                $array["msg"] = 'Bạn không đủ tiền!';
            } else {
                if ($sv == 1) {
                    $nd1 = 'Tăng Follow Profile ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `dichvu` SET `dv` = 'Sub',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `idgd`='Đang lấy...', `bh`='$sv', `sttdone` = '0'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Follow Thành Công! Cảm ơn bạn!!';
                }
            }
        } else {
            $array["status"] = 'error';
            $array["msg"] = 'Lỗi Server Tăng Follow Không Đúng!';
        }
    } else {
        $array["status"] = 'error';
        $array["msg"] = 'Token không tồn tại!';
    }
    echo json_encode($array);
} else {
    echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
}
