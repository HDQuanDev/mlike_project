<?
$hdq = "ok";
$page = 'view_story';
require_once('../../../_System/db.php');
include('../../../module/tds.php');
$gia = $gia1;
$min = '50';
$max = '10000';
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sl = mysqli_real_escape_string($db, $_POST['sl']);
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
                $tongtien = ($sl * $gia) - (($sl * $gia) / 100 * $dis);
            } else {
                $tongtien = ($sl * $gia);
            }
        }
        if (empty($id)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số ID Story Facebook!';
        } elseif (empty($sl)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập số lượng View!';
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
            $nd1 = 'Tăng View Story ID:';
            $bd = $tongtien;
            $gt = '-';
            $idgd = '' . $id . ' (' . $sl . ')';
            $goc = $row['vnd'];
            $time = time();
            $user = $s['user'];
            $pass = $s['pass'];
            $login_tds = json_decode(login($user, urlencode($pass)));
            if ($login_tds->success == 'true') {
                $date_create =  date("Y-m-d H:i:s");
                $send_api = send_tds_story(trim($id), trim($sl), '', $date_create);
                usleep(1000);
                if (strpos($send_api, 'nh công') !== false) {
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_viewstory',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = '4', `bh`='1', `sttdone` = '0'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua View Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'Lỗi Link story, vui lòng thử lại!';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Lỗi Server, vui lòng đợi ít phút và thửu lại!';
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
