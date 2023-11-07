<?
$hdq = "ok";
$page = 'follow_tt';
require_once('../../../_System/db.php');
require_once('../../../module/subgiare.php');
require_once('../../../module/viewyt.php');
require_once('../../../module/tiktok.php');
require_once('../../../module/autofb88.php');
$gia = $gia1;
$min = '100';
$max = 3000;
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
        $tt = json_decode(check_tt($id, "follow"));
        $ttid = $tt->id;
        $ttview = $tt->follow;
        //$id = $tt->nickname;
        $uname = $tt->username;
        if ($sv == 1) {
            $tongtien = $sl * $gia;
            $nse = 'Server Follow 1';
        } elseif ($sv == 2) {
            $tongtien = $sl * $gia2;
            $nse = 'Server Follow 2';
        } elseif ($sv == 3) {
            $tongtien = $sl * $gia3;
            $nse = 'Server Follow 3';
        } elseif ($sv == 4) {
            $tongtien = $sl * $gia4;
            $nse = 'Server Follow 4';
        } elseif ($sv == 5) {
            $tongtien = $sl * $gia5;
            $nse = 'Server Follow 5';
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
                require_once('../../../module/autofbpro.php');
                $buff = tiktok("$id", "$sl", "follow");
                $buff = json_decode($buff);
                if ($buff->status == 200) {

                    $nd1 = 'Tăng Follow TikTok ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(1) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_follow',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Follow Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 2) {
                $order = $api->order(array('service' => 1465, 'link' => '' . $id . '', 'quantity' => $sl));
                if (isset($order)) {

                    $nd1 = 'Tăng Follow TikTok ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(2) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_follow',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview', `idgd` = '$idd'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Follow Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 3) {
                require_once('../../../module/tds.php');
                $nd1 = 'Tăng Follow TikTok ID:';
                $bd = $tongtien;
                $gt = '-';
                $idgd = '(3) ' . $id . ' (' . $sl . ')';
                $goc = $row['vnd'];
                $time = time();
                $user = $s['user'];
                $pass = $s['pass'];
                $login_tds = json_decode(login($user, urlencode($pass)));
                if ($login_tds->success == 'true') {
                    $date_create =  date("Y-m-d H:i:s");
                    $send_api = send_tds_tt('follow', $id, trim($sl), '', $date_create);
                    usleep(1000);
                    if (strpos($send_api, 'nh công') !== false) {
                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                        mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_follow',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '$sl', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '0'");
                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                        $array["status"] = 'success';
                        $array["msg"] = 'Mua Follow Thành Công! Cảm ơn bạn!!';
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Lỗi ID vui lòng kiểm tra lại!';
                    }
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = 'Lỗi Server, vui lòng thử lại sau!';
                }
            } elseif ($sv == 4) {
                $buff = sgr_ttfollow("$uname", "sv7", "$sl", "");
                $buff = json_decode($buff);
                if ($buff->status == true) {
                    $nd1 = 'Tăng Follow TikTok ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(1) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_follow',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Follow Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 5) {
                $buff = subtt88("$uname", "$sl");
                $buff = json_decode($buff);
                if ($buff->status == 200) {
                    $nd1 = 'Tăng Follow TikTok ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(5) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `goc` = '$goc', `loai` = '1', `idgd` = '$idgd', `gt` = '$gt'");
                    mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'tiktok_follow',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `sttdone` = '10', `sotien` = '$tongtien', `done` = '0', `nse` = '$nse', `cmt` = '$ttid', `iddon` = '$ttview'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Follow Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } else {
                $array["status"] = 'error';
                $array["msg"] = 'Lỗi Server Tăng Follow Không Đúng!';
            }
        }
    } else {
        $array["status"] = 'error';
        $array["msg"] = 'Token không tồn tại!';
    }
    $array["uname"] = $id;
    echo json_encode($array);
} else {
    echo '{"status":"error","msg":"Không đủ phần tử gọi đến api"}';
}
