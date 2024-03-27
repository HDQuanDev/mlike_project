<?php

$hdq = "ok";
$page = 'fb_feeling';
require_once('../../../_System/db.php');
require_once('../../../module/tlc.php');
require_once('../../../module/tds.php');
$min = '30';
$max = '10000';
$array = [];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Method Not Allowed', true, 405);
    echo ''.$_SERVER['REQUEST_METHOD'].' method requests are not accepted for this resource';
    exit;
}
if (isset($_POST['token']) && isset($_POST['id']) && isset($_POST['sl']) && isset($_POST['sv']) && isset($_POST['cx'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $sl = mysqli_real_escape_string($db, $_POST['sl']);
    $cx = mysqli_real_escape_string($db, $_POST['cx']);
    $sv = mysqli_real_escape_string($db, $_POST['sv']);
    $cd = mysqli_real_escape_string($db, $_POST['gift']);
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $uu = mysqli_query($db, "SELECT * FROM `member` WHERE `token`='$token' AND `site` = '$site'");
    $tko = mysqli_num_rows($uu);
    if ($tko == '1') {
        $row = mysqli_fetch_assoc($uu);
        $login = $row['username'];
        if ($sv == 1 || $sv == 2) {
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
                        $nse = 'Server Cảm Xúc 1';
                    } elseif ($sv == 2) {
                        $tongtien = ($sl * $gia2) - (($sl * $gia2) / 100 * $dis);
                        $nse = 'Server Cảm Xúc 2';
                    }
                } else {
                    if ($sv == 1) {
                        $tongtien = ($sl * $gia1);
                        $nse = 'Server Cảm Xúc 1';
                    } elseif ($sv == 2) {
                        $tongtien = ($sl * $gia2);
                        $nse = 'Server Cảm Xúc 2';
                    }
                }
            }
            if (empty($id)) {
                $array["status"] = 'error';
                $array["msg"] = 'Vui lòng nhập số ID Bài Viết Facebook!';
            } elseif (empty($sl)) {
                $array["status"] = 'error';
                $array["msg"] = 'Vui lòng nhập số lượng Like!';
            } elseif (empty($cx)) {
                $array["status"] = 'error';
                $array["msg"] = 'Vui lòng chọn cảm xúc muốn tăng!';
            } elseif ($sl < $min) {
                $array["status"] = 'error';
                $array["msg"] = 'Số lượng phải lớn hơn ' . $min . '';
            } elseif ($sl > $max) {
                $array["status"] = 'error';
                $array["msg"] = 'Số lượng tối đa ' . $max . ' Like 1 lần ( Đợi lên xong hãy cài tiếp ( xem thực tế ở ngoài ) )!';
            } elseif ($row['vnd'] < $tongtien) {
                $array["status"] = 'error';
                $array["msg"] = 'Bạn không đủ tiền!';
            } else {
                if ($sv == 1) {
                    $nd1 = 'Mua Like Bài Viết ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(1) (Feeling) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    $send_tlc = json_decode(sv2_cx($id, $sl, $cx));
                    if ($send_tlc->success == 'true') {
                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                        mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_feeling',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = 'Server Cảm Xúc 1', `bh`='1', `sttdone` = '0'");
                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                        $array["status"] = 'success';
                        $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Đã xảy ra lỗi vui lòng kiểu tra lại!!';
                    }
                } elseif ($sv == 2) {
                    $nd1 = 'Mua Like Bài Viết ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(2) (Feeling) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    $user = $s['user'];
                    $pass = $s['pass'];
                    $login_tds = json_decode(login($user, urlencode($pass)));
                    if ($login_tds->success == 'true') {
                        $date_create =  date("Y-m-d H:i:s");
                        $send_api = send_tds_cx(trim($id), trim($sl), '', $date_create, $cx);
                        usleep(1000);
                        if (strpos($send_api, 'nh công') !== false) {
                            mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                            mysqli_query($db, "INSERT INTO `dv_other` SET `dv` = 'fb_feeling',`sl` = '$sl', `trangthai` = '2', `user`='$login',`profile`='$id',`time` = '$time', `sotien` = '$tongtien', `done` = '0', `nse` = 'Server Cảm Xúc 2', `bh`='2', `sttdone` = '0'");
                            mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                            $array["status"] = 'success';
                            $array["msg"] = 'Mua LIKE Thành Công! Cảm ơn bạn!!';
                        } else {
                            $array["status"] = 'error';
                            $array["msg"] = 'Lỗi ID tăng like vui lòng kiểu tra lại!!';
                        }
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = 'Lỗi Server Tăng Like Vui Lòng Liên Hệ Admin!';
                    }
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
