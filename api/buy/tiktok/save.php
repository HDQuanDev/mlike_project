<?php

$hdq = "ok";
$page = 'save_tt';
require_once('../../../_System/db.php');
require_once('../../../module/tiktok.php');
require_once('../../../module/ongtrum.php');
require_once('../../../module/autofb88.php');
$gia = $gia1;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo '' . $_SERVER['REQUEST_METHOD'] . ' method requests are not accepted for this resource';
    exit;
}
$array = [];
if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['sv'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sl = mysqli_real_escape_string($db, $_POST['sl']);
    $sv = mysqli_real_escape_string($db, $_POST['sv']);
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
    $tko = mysqli_num_rows($uu);
    if ($tko == '1') {
        $row = mysqli_fetch_assoc($uu);
        $login = $row['username'];
        if ($sv == 1) {
            $tongtien = $sl * $gia1;
            $nse = 'Server Save 1';
            $min = 50;
            $max = 1000000;
        } elseif ($sv == 2) {
            $tongtien = $sl * $gia2;
            $nse = 'Server Save 2';
            $min = 100;
            $max = 1000000;
        }
        if (empty($id)) {
            $array["status"] = 'error';
            $array["msg"] = 'Vui lòng nhập Link video!';
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
            if (filter_var($id, FILTER_VALIDATE_URL) !== false) {
                $tt = json_decode(check_tt($id, "view"));
                $ttid = $tt->id;
                $ttview = $tt->tim;
                $ttlink = $tt->link;
            } else {
                $ttid = $id;
                $ttview = '0';
            }
            if ($sv == 1) {
                $buff = json_decode(ongtrum("$ttid", "$ttlink", "50", "tiktok.buff.save", "$sl", "$ttview"));
                if ($buff->code == '200') {
                    $nd1 = '(1) Tăng Save TikTok ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'save_tt',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$ttid',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttlink', `iddon` = '$ttview'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Save Tiktok Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                    $array["link"] = '' . $ttlink . '';
                }
            } elseif ($sv == 2) {
                $buff = json_decode(savett88("$id", "$sl"));
                if ($buff->status == '200') {
                    $nd1 = '(2) Tăng Save TikTok ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'save_tt',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '0', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '0', `iddon` = '0'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Save Tiktok Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                    $array["link"] = '' . $ttlink . '';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Lỗi Server Không Đúng!';
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
