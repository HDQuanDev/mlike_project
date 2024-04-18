<?php

$hdq = "ok";
$page = 'live_fb';
require_once('../../../_System/db.php');
require_once('../../../module/live.php');
require_once('../../../module/autofb88.php');
require_once('../../../module/new97.php');
require_once('../../../module/baostar.php');
$min = '50';
$max = '2000';
$mgr = 'LIVEAPR'; //mã giảm giá, nếu không có điền quandz
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
                    $tongtien = ($sl * $gia1 * $phut) - (($sl * $gia1 * $phut) / 100 * $dis);
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2 * $phut) - (($sl * $gia2 * $phut) / 100 * $dis);
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3 * $phut) - (($sl * $gia3 * $phut) / 100 * $dis);
                } elseif ($sv == 4) {
                    $tongtien = ($sl * $gia4 * $phut) - (($sl * $gia4 * $phut) / 100 * $dis);
                } elseif ($sv == 5) {
                    $tongtien = ($sl * $gia5 * $phut) - (($sl * $gia5 * $phut) / 100 * $dis);
                } elseif ($sv == 6) {
                    $tongtien = ($sl * $gia6 * $phut) - (($sl * $gia6 * $phut) / 100 * $dis);
                } elseif ($sv == 7) {
                    $tongtien = ($sl * $gia7 * $phut) - (($sl * $gia7 * $phut) / 100 * $dis);
                } elseif ($sv == 8) {
                    $tongtien = ($sl * $gia8 * $phut) - (($sl * $gia8 * $phut) / 100 * $dis);
                } elseif ($sv == 9) {
                    $tongtien = ($sl * $gia9 * $phut) - (($sl * $gia9 * $phut) / 100 * $dis);
                } elseif ($sv == 10) {
                    $tongtien = ($sl * $gia10 * $phut) - (($sl * $gia10 * $phut) / 100 * $dis);
                } elseif ($sv == 11) {
                    $tongtien = ($sl * $gia11 * $phut) - (($sl * $gia11 * $phut) / 100 * $dis);
                }
            } else {

                if ($sv == 1) {
                    $tongtien = ($sl * $gia1 * $phut);
                } elseif ($sv == 2) {
                    $tongtien = ($sl * $gia2 * $phut);
                } elseif ($sv == 3) {
                    $tongtien = ($sl * $gia3 * $phut);
                } elseif ($sv == 4) {
                    $tongtien = ($sl * $gia4 * $phut);
                } elseif ($sv == 5) {
                    $tongtien = ($sl * $gia5 * $phut);
                } elseif ($sv == 6) {
                    $tongtien = ($sl * $gia6 * $phut);
                } elseif ($sv == 7) {
                    $tongtien = ($sl * $gia7 * $phut);
                } elseif ($sv == 8) {
                    $tongtien = ($sl * $gia8 * $phut);
                } elseif ($sv == 9) {
                    $tongtien = ($sl * $gia9 * $phut);
                } elseif ($sv == 10) {
                    $tongtien = ($sl * $gia10 * $phut);
                } elseif ($sv == 11) {
                    $tongtien = ($sl * $gia11 * $phut);
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
        } elseif ($phut < '30' || $phut > '1440') {
            $array["status"] = 'error';
            $array["msg"] = 'Số phút bạn muốn xem phải trong khoảng 30 phút đến 1440 phút!';
        } elseif ($row['vnd'] < $tongtien) {
            $array["status"] = 'error';
            $array["msg"] = 'Bạn không đủ tiền!';
        } else {
            if ($sv == 1) {
                $buff = live($id, $sl, $phut, $sv, $mgr);
                $buff = json_decode($buff);
                if ($buff->data[0]->status == 'true') {
                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(1) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    $idgdd = $buff->data[0]->id;
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '$idgdd', `sttdone` = '0', `sv` = 'Server Live 1'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->data[0]->message[0] . '';
                }
            } elseif ($sv == 2) {
                $buff = live($id, $sl, $phut, $sv, $mgr);
                $buff = json_decode($buff);
                if ($buff->data[0]->status == 'true') {
                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(2) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    $idgdd = $buff->data[0]->id;
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '$idgdd', `sttdone` = '0', `sv` = 'Server Live 2'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->data[0]->message[0] . '';
                }
            } elseif ($sv == 3) {
                $buff = live($id, $sl, $phut, $sv, $mgr);
                $buff = json_decode($buff);
                if ($buff->data[0]->status == 'true') {
                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(3) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    $idgdd = $buff->data[0]->id;
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '$idgdd', `sttdone` = '0', `sv` = 'Server Live 3'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->data[0]->message[0] . '';
                }
            } elseif ($sv == 4) {
                $buff = live($id, $sl, $phut, $sv, $mgr);
                $buff = json_decode($buff);
                if ($buff->data[0]->status == 'true') {

                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(4) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    $idgdd = $buff->data[0]->id;
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '$idgdd', `sttdone` = '0', `sv` = 'Server Live 4'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->data[0]->message[0] . '';
                }
            } elseif ($sv == 5) {
                $buff = live8($id, $sl, $phut, "45_10");
                $buff = json_decode($buff);
                if ($buff->status == '200') {
                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(5) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '0', `sttdone` = '0', `sv` = 'Server Live 5'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 6) {
                $buff = live8($id, $sl, $phut, "45_2");
                $buff = json_decode($buff);
                if ($buff->status == '200') {
                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(6) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '0', `sttdone` = '0', `sv` = 'Server Live 6'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->message . '';
                }
            } elseif ($sv == 7) {
                $channel = '3';
                $buff = new97($id, $sl, $phut, $channel);
                $buff = json_decode($buff);
                if ($buff->status == 'success') {
                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(7) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    $idgdd = $buff->data[0]->id;
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '$idgdd', `sttdone` = '0', `sv` = 'Server Live 7'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->msg . '';
                }
            } elseif ($sv == 8) {
                $buff = new97($id, $sl, $phut, $sv);
                $buff = json_decode($buff);
                if (isset($buff->Id)) {
                    $nd1 = 'Tăng Mắt Livestream ID:';
                    $bd = $tongtien;
                    $gt = '-';
                    $idgd = '(8) ' . $id . ' (' . $sl . ')';
                    $goc = $row['vnd'];
                    $time = time();
                    mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                    $idgdd = $buff->data[0]->id;
                    mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '$idgdd', `sttdone` = '0', `sv` = 'Server Live 8'");
                    mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                    $array["status"] = 'success';
                    $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                } else {
                    $array["status"] = 'error';
                    $array["msg"] = '' . $buff->Data . '';
                }
            } elseif ($sv == 9 || $sv == 10 || $sv == 11) {
                if (filter_var($id, FILTER_VALIDATE_URL) == false) {
                    $array["status"] = 'error';
                    $array["msg"] = 'Vui lòng sử dụng Link Live không sử dụng ID!';
                } else {
                    $buff = baostar_live($id, $sl, $sv);
                    $buff = json_decode($buff);
                    if ($buff->success = 'true') {
                        $nd1 = 'Tăng Mắt Livestream ID:';
                        $bd = $tongtien;
                        $gt = '-';
                        $idgd = '(' . $sv . ') ' . $id . ' (' . $sl . ')';
                        $goc = $row['vnd'];
                        $time = time();
                        mysqli_query($db, "INSERT INTO `lichsu` SET `nd` = '$nd1',`bd` = '$bd',`user`='$login',`time`='$time', `idgd` = '$idgd', `gt` = '$gt', `goc` = '$goc', `loai` = '1'");
                        $idgdd = 'null';
                        $gsv = 'Server Live ' . $sv;
                        mysqli_query($db, "INSERT INTO `video` SET `dv` = 'mat',`sl` = '$sl', `trangthai` = '1', `user`='$login',`profile`='$id',`time` = '$time', `start` = 'Đang lấy...', `phut` = '$phut', `idgd` = '$idgdd', `sttdone` = '0', `sv` = '$gsv'");
                        mysqli_query($db, "UPDATE `member` SET `vnd` = `vnd`-'$tongtien', `sd` = `sd`+'$tongtien' WHERE `username` = '$login' AND `site` = '$site'");
                        $array["status"] = 'success';
                        $array["msg"] = 'Mua Mắt Thành Công! Cảm ơn bạn!!';
                    } else {
                        $array["status"] = 'error';
                        $array["msg"] = '' . $buff->message . '';
                    }
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
