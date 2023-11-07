<?
$hdq = "ok";
$page = 'live_tt';
require_once('../../../_System/db.php');
require_once('../../../module/viewyt.php');
$gia = $gia1;
$api = new Api();
$min = '1000000';
$max = '10';
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['phut'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sl = mysqli_real_escape_string($db, $_POST['sl']);
    $phut = mysqli_real_escape_string($db, $_POST['phut']);
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
    $tko = mysqli_num_rows($uu);
    if ($tko == '1') {
        $row = mysqli_fetch_assoc($uu);
        $login = $row['username'];
        $tongtien = $gia * $sl * $phut;
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
            if ($phut == '30') {
                $order = $api->order(array('service' => 1696, 'link' => '' . $id . '', 'quantity' => $sl));
            } elseif ($phut == '60') {
                $order = $api->order(array('service' => 1697, 'link' => '' . $id . '', 'quantity' => $sl));
            } elseif ($phut == '90') {
                $order = $api->order(array('service' => 1698, 'link' => '' . $id . '', 'quantity' => $sl));
            } elseif ($phut == '120') {
                $order = $api->order(array('service' => 1699, 'link' => '' . $id . '', 'quantity' => $sl));
            } elseif ($phut == '180') {
                $order = $api->order(array('service' => 1700, 'link' => '' . $id . '', 'quantity' => $sl));
            } elseif ($phut == '240') {
                $order = $api->order(array('service' => 1701, 'link' => '' . $id . '', 'quantity' => $sl));
            }
            if (isset($order)) {
                $nd1 = 'Mua Mắt Livestream Tiktok ID:';
                $bd = $tongtien;
                $gt = '-';
                $idgd = '' . $id . ' (' . $sl . ') (' . $phut . ' Phút)';
                $goc = $row['vnd'];
                $time = time();
                mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tt_live',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$tg'");
                mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login'");
                $array["status"] = 'success';
                $array["msg"] = 'Mua Mắt Live Thành Công! Cảm ơn bạn!!';
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Lỗi hệ thống, hoặc số phút không hợp lệ';
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
