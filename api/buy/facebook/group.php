<?
$hdq = "ok";
$page = 'group_fb';
require_once('../../../_System/db.php');
require_once('../../../module/autofbpro.php');
require_once('../../../module/tlc.php');
$min = '1000';
$max = '50000';
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
                    $nse = 'Server Group 1';
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                    $nse = 'Server Group 2';
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3) - (($sl * $gia3) / 100 * $dis);
                    $nse = 'Server Group 3';
                }
            } else {

                if ($sv == 1) {
                    $tongtien = ($sl * $gia1);
                    $nse = 'Server Group 1';
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2);
                    $nse = 'Server Group 2';
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3);
                    $nse = 'Server Group 3';
                }
            }
        }
        if (empty($id)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số ID Group Facebook!';
        } elseif (empty($sl)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số lượng Memner!';
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
                $send_tlc = json_decode(tlc_memgroup($id, $sl));
                if ($send_tlc->success == 'true') {
                    $nd1 = 'Tăng Member Group Facebook ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_group',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `sve` = '2', `nse` = '$nse'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Member Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'Đã xảy ra lỗi vui lòng thử lại hoặc liên hệ admin!!';
                }
            } elseif ($sv == 2 || $sv == 3) {
                $buff = group("$id", "$sl", "$sv");
                $buff = json_decode($buff);
                if ($buff->status == 200) {
                    $nd1 = 'Tăng Member Group Facebook ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_group',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `sve` = '2', `nse` = '$nse'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Member Thành Công! Cảm ơn bạn!!';
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
